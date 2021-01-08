<?php
public function stripe(Request $request)
    {
        $id = User::where(['email'=>Session::get('userSession')])->first()->id;
        DB::table('carts')->where(['user_id'=>$id])->delete();


        if($request->isMethod('post'))
        {
            $data = $request->all();
            echo "<pre>"; print_r($data); die;

            $name         = $request->input('name');
            $total_amount = $request->input('total_amount');

            if(!empty($_POST['stripeToken']))
            {
                $token   = $_POST['stripeToken'];
            }
            else
            {
                $token = NULL;
            }

            $card         = $request->input('card');

            // for checking choose card
            if(!empty($card))
            {
                // echo $card; die;

                $cid = User::where(['email'=>Session::get('userSession')])->first()->cid;

                // echo $cid; echo "<br>";
                // echo $card; die;

                // for create customer 
                \Stripe\Stripe::setApiKey('sk_test_51I42lDHfrmRAqAIlrhreuHmIUWdtDFwreThzuDnN8StuRExI7PhYqdoNk6NBqjIyyXegrPcof3pTe2axD3C9GRAR00Aq9PaH32');

                // for create payment
                $charge = \Stripe\charge::Create([
                                                    'customer' => $cid,
                                                    'source'   => $card,
                                                    'shipping' => [
                                                        'name' => $name,
                                                        'address' => [
                                                          'line1' => 'address test',
                                                          'postal_code' => '12345',
                                                          'city' => 'San Francisco',
                                                          'state' => 'CA',
                                                          'country' => 'US',
                                                        ],
                                                      ],                            // end extra
                                                    'amount' => 98765,
                                                    'currency' => 'inr',
                                                    'description' => $name,
                                                    // 'source' => $token,
                ]);

                echo "done"; die;

            }

            // for checking new card
            if(!empty($token))
            {
                $cid = User::where(['email'=>Session::get('userSession')])->first()->cid;

                // echo $cid; echo "<br>";
                // echo $token; die;

                if(!empty($cid))
                {
                    $stripe = new \Stripe\StripeClient(
                      'sk_test_51I42lDHfrmRAqAIlrhreuHmIUWdtDFwreThzuDnN8StuRExI7PhYqdoNk6NBqjIyyXegrPcof3pTe2axD3C9GRAR00Aq9PaH32'
                    );

                    $new_card = $stripe->customers->createSource(
                      $cid,
                      ['source' => $token]
                    );

                    // echo $new_card; die;
                    
                    // for create customer 
                    \Stripe\Stripe::setApiKey('sk_test_51I42lDHfrmRAqAIlrhreuHmIUWdtDFwreThzuDnN8StuRExI7PhYqdoNk6NBqjIyyXegrPcof3pTe2axD3C9GRAR00Aq9PaH32');

                    // for create payment
                    $charge = \Stripe\charge::Create([
                                                        'customer' => $cid,
                                                        'shipping' => [
                                                            'name' => $name,
                                                            'address' => [
                                                              'line1' => 'address test',
                                                              'postal_code' => '12345',
                                                              'city' => 'San Francisco',
                                                              'state' => 'CA',
                                                              'country' => 'US',
                                                            ],
                                                          ],                            // end extra
                                                        'amount' => $total_amount,
                                                        'currency' => 'inr',
                                                        'description' => $name,
                                                        'source' => $new_card->id,
                    ]);
                }
                else
                {
                    // for create customer 
                    \Stripe\Stripe::setApiKey('sk_test_51I42lDHfrmRAqAIlrhreuHmIUWdtDFwreThzuDnN8StuRExI7PhYqdoNk6NBqjIyyXegrPcof3pTe2axD3C9GRAR00Aq9PaH32');

                    $customer = \Stripe\Customer::create([
                        'source' => $token,
                        'name' => $request->input('name'),
                        'email' => Session::get('userSession'),
                        'description' => 'kuch bhi...',
                    ]);

                    // for create payment
                    $charge = \Stripe\charge::Create([
                                                        'customer' => $customer->id,
                                                        'shipping' => [
                                                            'name' => $name,
                                                            'address' => [
                                                              'line1' => 'address test',
                                                              'postal_code' => '12345',
                                                              'city' => 'San Francisco',
                                                              'state' => 'CA',
                                                              'country' => 'US',
                                                            ],
                                                          ],                            // end extra
                                                        'amount' => $total_amount,
                                                        'currency' => 'inr',
                                                        'description' => $name,
                                                        // 'source' => $token,
                    ]);

                    User::where(['email'=>Session::get('userSession')])->update(['cid'=>$customer->id]);
                }
            }
            return redirect()->back()->with('flash_message_success','Your Payment Successfully Done!');
        }

        // for retrive customer all cards
        $cid = User::where(['email'=>Session::get('userSession')])->first()->cid;

        if(!empty($cid))
        {
            $stripe = new \Stripe\StripeClient(
              'sk_test_51I42lDHfrmRAqAIlrhreuHmIUWdtDFwreThzuDnN8StuRExI7PhYqdoNk6NBqjIyyXegrPcof3pTe2axD3C9GRAR00Aq9PaH32'
            );
            
            $cards = $stripe->customers->allSources(
              $cid,
              ['object' => 'card']
            );

            // echo "<pre>"; print_r($cards); die;
        }
        else
        {
            $cards = NULL;
        }

        return view('user.stripe')->with(compact('cards'));
    }
?>