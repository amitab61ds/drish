<?php
namespace frontend\controllers;
use common\models\Discount;
use common\models\DiscountCode;
use common\models\GuestUser;
use common\models\OrderItems;
use common\models\PaymentMethods;
use common\models\ProductImages;
use common\models\Profile;
use common\models\User;
use frontend\models\DiscountForm;
use frontend\models\SignupForm;
use yii\web\Response;
use common\models\Cities;
use common\models\CitiesSearch;
use common\models\Countries;
use common\models\CountriesSearch;
use common\models\States;
use common\models\StatesSearch;
use common\models\Cart;
use common\models\Product;
use common\models\Orders;
use common\models\BillingAddress;
use common\models\ShippingAddress;
use common\models\VarientProduct;
use Yii;
use common\rbac\helpers\RbacHelper;
use nenad\passwordStrength\StrengthValidator;
use yii\helpers\Url;


class CartController extends FrontendController
{
    public function actionAdd()
    {
		$model = new Cart();
		if($model->load(Yii::$app->request->post()) && $model->validate())
		{
			$session = Yii::$app->session;

			if (!$session->isActive){
				// open a session
				$session->open();
			}
			if ($session->has('cart')) {
				$cart = $session->get('cart');
			}else{
				$cart = array();
			}
			if($model->varient_id == ''){
				$varient = VarientProduct::find()->where(['product_id'=>$model->product_id,'color'=>$model->color,'width'=>$model->width,'size'=>$model->size])->one();
				$model->varient_id = $varient->id;
			}
			if(Yii::$app->user->isGuest) {

				$cart[$model->varient_id]['product_id'] = $model->product_id;
				$cart[$model->varient_id]['color'] = $model->color;
				$cart[$model->varient_id]['size'] = $model->size;
				$cart[$model->varient_id]['width'] = $model->width;
				$cart[$model->varient_id]['quantity'] = $model->quantity;
				$cart[$model->varient_id]['discount'] = 0;
				if($model->quantity > 0)
					$session->set('cart', $cart);
			}else{

				if (($cartmodel = Cart::find()->where(['varient_id'=>$model->varient_id,'product_id'=>$model->product_id,'user_id'=>Yii::$app->user->identity->id])->one()) !== null) {

					$cartmodel->color = $model->color;
					$cartmodel->size = $model->size;
					$cartmodel->width = $model->width;
					$cartmodel->quantity = $model->quantity;
					if($model->quantity > 0)
						$cartmodel->save();
				}else{
					$model->user_id = Yii::$app->user->identity->id;
					if($model->quantity > 0)
						$model->save();
				}

			}
			if(!Yii::$app->user->isGuest) {
				$query = Cart::find();
				$query->where(['user_id' => Yii::$app->user->identity->id]);
				$countitems = $query->count();
			}else{
				$session = Yii::$app->session;
				$countitems = count($session->get('cart'));
			}
			$product = Product::findOne($model->product_id);
			$message = $product->name." has beed added to cart!";
			$result['type'] = 'success';
			$result['message'] = $message;
			$result['count'] = $countitems;
			Yii::$app->response->format = trim(Response::FORMAT_JSON);
				return $result;
		}else{

			$error = \yii\widgets\ActiveForm::validate($model);
				Yii::$app->response->format = trim(Response::FORMAT_JSON);
				return $error; 
		}	

    }
	public function actionActiveStates($id)
    {
        $model = new States();
        $model->country_id = $id;
        $states = $model->getStates();
        Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            'states' => $states,
            'cities' => '<option value="">- Select City -</option>',
        ];
    }
    public function actionActiveCities($id)
    {
        $model = new Cities();
        $model->state_id = $id;
        $cities = $model->getCities();
        Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            $cities
        ];
    }

	public function actionCart()
	{
		$this->layout = 'page';

		$cartModel = new Cart();
		$carts =$cartModel->getResetCart();
		return $this->render('cart',['items'=>$carts
		]);

	}
	public function actionRemove($id)
	{
		$session = Yii::$app->session;

		if(Yii::$app->user->isGuest) {
			if ($session->has('cart')) {
				$cart = $session->get('cart');
				$product_id = $cart[$id]['product_id'];
				unset($cart[$id]);
				$session->set('cart', $cart);
				$session->set('changed', 1);
			}
		}else{
			if (($cartmodel = Cart::find()->where(['varient_id'=>$id,'user_id'=>Yii::$app->user->identity->id])->one()) !== null) {
				$product_id = $cartmodel->product_id;
				$cartmodel->delete();
			}
		}
		$product = Product::findOne($product_id);

		$message = $product->name." has beed removed from cart!";

		Yii::$app->getSession()->setFlash('success', Yii::t('app', $message));
		return $this->redirect(['cart/cart']);
	}
	public function actionCheckout()
	{
		$this->layout = 'page';
		if(Yii::$app->user->isGuest){
			$userid = 0;
		}else{
			$userid = Yii::$app->user->identity->id;
		}
		$result = Cart::getCartItemsCount($userid);
		if($result){
			$order = new Orders();
			$order->payment_method = 1;
			$payment = new Orders();
			$payment->payment_method = 1;

			return $this->render('checkout',['order'=> $order,'payment'=>$payment]);

		}else{
			return $this->redirect(['cart/cart']);
		}



	}
	public function actionAddress()
	{
		$session = Yii::$app->session;
		if(Yii::$app->user->isGuest){
			$userid = 0;
		}else{
			$userid = Yii::$app->user->identity->id;
		}
		$result = Cart::getCartItemsCount($userid);
		if($result == 0){
			return $this->redirect(['cart/cart']);
		}
		if (!Yii::$app->user->isGuest) {
			$billingModel = BillingAddress::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
			$shippingModel = ShippingAddress::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
			if(!$billingModel)
				$billingModel = new BillingAddress();

			if(!$shippingModel)
				$shippingModel = new ShippingAddress();
		}else{
			$billingModel = new BillingAddress();
			$shippingModel = new ShippingAddress();

		}

		if (Yii::$app->request->isPost && Yii::$app->request->isAjax && $billingModel->load(Yii::$app->request->post()) ) {

			$billingModel->city_id = 1;
			$billingModel->state_id = 13;
			$billingModel->country_id = 101;


			if(Yii::$app->user->isGuest) {
				if (!empty($_SERVER['HTTP_CLIENT_IP']))
				{
					$ip=$_SERVER['HTTP_CLIENT_IP'];
				}
				elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
				{
					$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
				}
				else
				{
					$ip=$_SERVER['REMOTE_ADDR'];
				}

				$guestModel = GuestUser::find()->where(['email'=>$billingModel->email,'ip'=>$ip])->one();
				if(!$guestModel)
					$guestModel = new GuestUser();

				$guestModel->load(Yii::$app->request->post());

				if ($guestModel->new_account == 1) {
					if (!$session->has('userid')) {
						$userModel = new User();
						$profileModel = new Profile();

						$userModel->username = $billingModel->email;
						$userModel->email = $billingModel->email;
						$userModel->status = 10;
						$userModel->setPassword($guestModel->password);
						$userModel->generateAuthKey();
						$rna = Yii::$app->params['rna'];
						// if scenario is "rna" we will generate account activation token
						if ($rna) {
							$userModel->generateAccountActivationToken();
						}


						if ($userModel->save() && RbacHelper::assignRole($userModel->getId()) ? $userModel : null) {
							$profileModel->user_id = $userModel->id;
							$profileModel->fname = $billingModel->fname;
							$profileModel->lname = $billingModel->lname;
							$profileModel->phone = $billingModel->phone;
							$profileModel->save();

						} else {
							Yii::$app->response->format = Response::FORMAT_JSON;
							echo json_encode($userModel->getErrors());
							Yii::$app->end();
						}

						$guestid = $userModel->id;

						$session->set('userid', $guestid);
						$session->remove('guestid');
						$billingModel->user_id = $guestid;
						$shippingModel->user_id = $guestid;
					}else{
						$guestid = $session->get('userid');
						$billingModel->user_id = $guestid;
						$shippingModel->user_id = $guestid;

					}


				} else {

					$guestModel->fname = $billingModel->fname;
					$guestModel->lname = $billingModel->lname;
					$guestModel->email = $billingModel->email;
					$guestModel->phone = $billingModel->phone;
					$guestModel->password = $billingModel->phone;
					$guestModel->ip = $ip;
					if (!$guestModel->save()) {
						$err1 = $billingModel->getErrors();
						$err2 = $shippingModel->getErrors();
						$err3 = $guestModel->getErrors();
						Yii::$app->response->format = Response::FORMAT_JSON;
						echo json_encode(array_merge($err1 , $err2 , $err3));
						Yii::$app->end();

					}

					$guestid = $guestModel->id;
					$session = Yii::$app->session;
					$session->set('guestid',$guestid);
					$billingModel->guest_id = $guestid;
					$shippingModel->guest_id = $guestid;

				}

			}else{
				$userid = Yii::$app->user->identity->id;
				$billingModel->user_id = $userid;
				$shippingModel->user_id = $userid;
			}

			if($billingModel->is_shipping != 1){
				$shippingModel->fname = $billingModel->fname;
				$shippingModel->lname = $billingModel->lname;
				$shippingModel->address = $billingModel->address;
				$shippingModel->email = $billingModel->email;
				$shippingModel->phone = $billingModel->phone;
				$shippingModel->company = $billingModel->company;
				$shippingModel->zip = $billingModel->zip;
				$shippingModel->city_id = $billingModel->city_id;
				$shippingModel->state_id = $billingModel->state_id;
				$shippingModel->country_id = $billingModel->country_id;

			}else{
				$shippingModel->load(Yii::$app->request->post());
				$shippingModel->city_id = $billingModel->city_id;
				$shippingModel->state_id = $billingModel->state_id;
				$shippingModel->country_id = $billingModel->country_id;
			}



			if($billingModel->save() && $shippingModel->save()){
				$result = array();
				$result['type'] = 'success';
				Yii::$app->response->format = trim(Response::FORMAT_JSON);
				return $result;
			}else{
				$err1 = $billingModel->getErrors();
				$err2 = $shippingModel->getErrors();
				Yii::$app->response->format = Response::FORMAT_JSON;
				echo json_encode(array_merge($err1 , $err2));
				Yii::$app->end();
			}

		}

	}
	public function actionPlaceOrder($orderid=0)
	{
		if(Yii::$app->user->isGuest){
			$userid = 0;
		}else{
			$userid = Yii::$app->user->identity->id;
		}
		$result = Cart::getCartItemsCount($userid);
		if($result == 0 && $orderid == 0){
			return $this->redirect(['cart/cart']);
		}

		$this->layout = 'page';

			$orders = new Orders();
			if (Yii::$app->request->isPost && Yii::$app->request->isAjax  ) {
				$session = Yii::$app->session;

				if ($session->has('payment_method')) {
					$paymentid = $session->get('payment_method');
					$orders->payment_method = $paymentid;
				}else{
					$orders->payment_method = 1;
				}

				$cartModel = new Cart();
				$cart = $cartModel->getFinalCart();
				if ($session->has('discountid')) {
					$discountid = $session->get('discountid');
					$orders->discount_id = $discountid;
				}


				if (!Yii::$app->user->isGuest) {
					$orders->user_id = Yii::$app->user->identity->id;
				}else{
					if( $session->get('guestid') != '')
						$orders->guest_id = $session->get('guestid');
					if( $session->get('userid') != '')
						$orders->user_id = $session->get('userid');
				}
				$orders->items_count = count($cart);
				$orders->price_total = $cart['total'];
				$orders->delivery_charges = 0;
				$orders->cod_charge = 0;
				if($orders->payment_method == 1){
					$orders->cod_charge = round((2 * $cart['total'])/100);
				}

				$orders->discount = $cart['discount'];

				$orders->grand_total = floatval($cart['total'] + $orders->delivery_charges + $orders->cod_charge);
				$orders->status = 1;
				$orders->locked = 0;
				$orders->payment_status = 1;



				if($orders->save()){

				if($orders->payment_method == 2) {
					$working_key = '';//Shared by CCAVENUES
					$access_code = '';//Shared by CCAVENUES
					$merchant_data = '';

					$ccavenue_data = array();

					$ccavenue_data['merchant_id'] =
					$ccavenue_data['order_id'] = $orders->id;
					$ccavenue_data['currency'] = 'INR';
					$ccavenue_data['amount'] = $orders->grand_total;
					$ccavenue_data['redirect_url'] = Url::to('cart/response', true);
					$ccavenue_data['cancel_url'] = Url::to('cart/response', true);
					$ccavenue_data['integration_type'] = 'iframe_normal';
					$ccavenue_data['language'] = 'EN';
					$orderdata = $orders->getOrderDetail($orders->id);


					$ccavenue_data['billing_name'] = $orderdata['billing']['fname'] . ' ' . $orderdata['billing']['lname'];
					$ccavenue_data['billing_address'] = $orderdata['billing']['address'];
					$ccavenue_data['billing_city'] = $orderdata['billing']['city'];
					$ccavenue_data['billing_state'] = $orderdata['billing']['state'];
					$ccavenue_data['billing_zip'] = $orderdata['billing']['zip'];
					$ccavenue_data['billing_country'] = $orderdata['billing']['country'];
					$ccavenue_data['billing_tel'] = $orderdata['billing']['phone'];
					$ccavenue_data['billing_email'] = $orderdata['billing']['email'];

					if ($orderdata['billing']['is_shipping'] != 0) {
						$ccavenue_data['delivery_name'] = $orderdata['shipping']['fname'] . ' ' . $orderdata['billing']['lname'];
						$ccavenue_data['delivery_address'] = $orderdata['shipping']['address'];
						$ccavenue_data['delivery_city'] = $orderdata['shipping']['city'];
						$ccavenue_data['delivery_state'] = $orderdata['shipping']['state'];
						$ccavenue_data['delivery_zip'] = $orderdata['shipping']['zip'];
						$ccavenue_data['delivery_country'] = $orderdata['shipping']['country'];
						$ccavenue_data['delivery_tel'] = $orderdata['shipping']['phone'];
					} else {
						$ccavenue_data['delivery_name'] = $orderdata['billing']['fname'] . ' ' . $orderdata['billing']['lname'];
						$ccavenue_data['delivery_address'] = $orderdata['billing']['address'];
						$ccavenue_data['delivery_city'] = $orderdata['billing']['city'];
						$ccavenue_data['delivery_state'] = $orderdata['billing']['state'];
						$ccavenue_data['delivery_zip'] = $orderdata['billing']['zip'];
						$ccavenue_data['delivery_country'] = $orderdata['billing']['country'];
						$ccavenue_data['delivery_tel'] = $orderdata['billing']['phone'];

					}

					$ccavenue_data['merchant_param1'] = $orderdata['usertype'];
					$ccavenue_data['merchant_param2'] = $orderdata['id'];

					foreach ($ccavenue_data as $key => $value) {
						$merchant_data .= $key . '=' . $value . '&';
					}

					$encrypted_data = $orders->encrypt($merchant_data, $working_key); // Method for encrypting the data.

					$orders->production_url = 'https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction&encRequest=' . $encrypted_data . '&access_code=' . $access_code;


				}

					foreach($cart['items'] as $key => $item){
						$itemModel = new OrderItems();
						$itemModel->order_id = $orders->id;
						$itemModel->product_id = $item['product_id'];
						$itemModel->varient_id = $key;
						$itemModel->quantity = $item['quantity'];
						$itemModel->defaultrate = $item['singleprice'];
						$itemModel->total = floatval($item['singleprice'] - $item['discount']);
						$itemModel->discount = $item['discount'];

						if($itemModel->save()){
							if (!Yii::$app->user->isGuest) {
								if (isset($item['id']) && ($cartModel = Cart::findOne($item['id'])) !== null) {
									$cartModel->delete();
								}
							}else{
								if ($session->has('cart')) {
									$data = $session->get('cart');
									unset($data[$key]);
									$session->set('cart',$data);
								}
							}
						}

					}
					if ($session->has('discountid')) {
						$session->remove('discountid');
					}
					if ($session->has('payment_method')) {
						$session->remove('payment_method');
					}
					if($orders->payment_method == 1){
						return $this->render('place-order',['orderid'=>$orderid]);
					}else{
						return $this->redirect(['cart/payment','order'=>$orders]);
					}

				}else{

					Yii::$app->response->format = Response::FORMAT_JSON;
					echo json_encode(ActiveForm::validate($orders));
					Yii::$app->end();
				}
			}else{

				return $this->render('place-order',['orderid'=>$orderid]);
			}


	}

	public function actionDiscount(){
		$model = new DiscountForm();
		$cartModel = new Cart();
		$session = Yii::$app->session;
		if (Yii::$app->request->isPost && Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){

			$cartModel->getRemoveDiscount();

			$discountModel = DiscountCode::find()->where(['code'=>$model->code,'status'=>0])->one();
			if ($discountModel !== null && $discountModel->discount->status == 1 && $discountModel->discount->locked == 0) {
				$validate = $cartModel->getvalidateCart($model->code);
				if($validate == 1) {
					$discountModel->status = 0;
					$discountModel->locked = 1;
					$discModel = Discount::findOne($discountModel->discount_id);
					$discModel->quantity_used = $discModel->quantity_used + 1;
					$discModel->quantity_left = $discModel->quantity_left - 1;

					if ($discModel->save()) {

					} else {
						Yii::$app->response->format = Response::FORMAT_JSON;
						$message = array();
						$message['type'] = 'error';
						$message['msg'] = 'Something wrong happen! Please try after some time. ';
						echo json_encode($message);
						Yii::$app->end();
					}

					if ($discountModel->save()) {


						Yii::$app->response->format = Response::FORMAT_JSON;
						$session->set('discountid', $discountModel->id);
						$message = array();

						$message['type'] = 'success';
						$message['msg'] = 'Conratulations! Discount added in your cart. ';
						echo json_encode($message);
						Yii::$app->end();
					} else {

						$discModel->quantity_used = $discModel->quantity_used - 1;
						$discModel->quantity_left = $discModel->quantity_left + 1;
						$discModel->save();

						Yii::$app->response->format = Response::FORMAT_JSON;
						$message = array();
						$message['type'] = 'error';
						$message['msg'] = 'Something wrong happen! Please try after some time. ';
						echo json_encode($message);
						Yii::$app->end();
					}
				}else if($validate == 2){
					Yii::$app->response->format = Response::FORMAT_JSON;
					$message = array();
					$message['type'] = 'error';
					$message['msg'] = 'Coupon not applicable for products available in your cart !';
					echo json_encode($message);
					Yii::$app->end();
				}else{
					Yii::$app->response->format = Response::FORMAT_JSON;
					$message = array();
					$message['type'] = 'error';
					$message['msg'] = 'Coupon not valid!';
					echo json_encode($message);
					Yii::$app->end();
				}

			} else {
				Yii::$app->response->format = Response::FORMAT_JSON;
				$message = array();
				$message['type'] = 'error';
				$message['msg'] = 'Coupon not valid!';
				echo json_encode($message);
				Yii::$app->end();
			}
		}

	}

	public function actionResponse(){
		if($_POST){
			$order = new Orders();
			$workingKey='';		//Working Key should be provided here.
			$encResponse= $_POST["encResp"];			//This is the response sent by the CCAvenue Server
			$rcvdString= $order->decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
			$order_status="";
			$decryptValues=explode('&', $rcvdString);
			$dataSize=sizeof($decryptValues);
			echo "<pre>";
			print_r($decryptValues);
			die;
			for($i = 0; $i < $dataSize; $i++)
			{
				$information=explode('=',$decryptValues[$i]);
				if($i==3)	$order_status=$information[1];
			}

			if($order_status==="Success")
			{

				echo "<br>Thank you for shopping with us. Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon.";

			}
			else if($order_status==="Aborted")
			{
				echo "<br>Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";

			}
			else if($order_status==="Failure")
			{
				echo "<br>Thank you for shopping with us.However,the transaction has been declined.";
			}
			else
			{
				echo "<br>Security Error. Illegal access detected";

			}
		}
	}
	public function actionImages(){
		$request = Yii::$app->request;
		if ($request->isAjax) {
			$color_id= Yii::$app->request->post('color_id');
			$product_id= Yii::$app->request->post('product_id');
			$data = ProductImages::find()->where(['color' => $color_id,'product_id' => $product_id])->one();
			if($data){
				$images = unserialize($data->other_image);
				$dt="";
				$medium_img = Yii::$app->params['baseurl'].'/uploads/product/main/'.$product_id.'/medium/'.$data->main_image;
				$thumb_img = Yii::$app->params['baseurl'].'/uploads/product/main/'.$product_id.'/main/'.$data->main_image; ;
				$dt .= '<div class="zoom-outer"><img id="zoom_01" src="'.$medium_img.'" data-zoom-image ="'.$thumb_img.'" /></div><div id="gal1">';
				foreach($images as $image){
				   $urllarge = Yii::$app->params['baseurl'].'/uploads/product/other/'.$product_id.'/main/'.$image;
				   $urlthumb = Yii::$app->params['baseurl'].'/uploads/product/other/'.$product_id.'/medium/'.$image;
				   $dt .= '<a href="#" data-image="'. $urlthumb .'" data-zoom-image="'. $urllarge .'">
						<img id="zoom_01" src="'. $urlthumb .'" /></a>';
				}
				$dt .=	'</div>';
				echo $dt; die;
			}
		}
	}
	public function actionPaymentMethod()
	{
		$session = Yii::$app->session;
		$order = new Orders();
		if (Yii::$app->request->isPost && Yii::$app->request->isAjax && $order->load(Yii::$app->request->post()) ) {
			if($order->validate()){

				$session->set('payment_method',$order->payment_method);



				$cartModel = new Cart();
				$cart = $cartModel->getFinalCart();
				$cart['type'] = 'success';


				Yii::$app->response->format = trim(Response::FORMAT_JSON);
				return $cart;
			}else{
				$result['type'] = 'error';
				$result['msg'] = \yii\widgets\ActiveForm::validate($order);
				Yii::$app->response->format = trim(Response::FORMAT_JSON);
				return $result;

			}

		}

	}
}
