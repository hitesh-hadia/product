    <?= $this->Html->link(__('New Addres'), ['controller' => 'Address','action' => 'add']) ?>
    <?= $this->Form->create('order',['id' => 'payment_form']) ?>
        <input type="hidden" name="transaction_id" id="razorpay_payment_id">
        <input type="hidden" name="order_id" id="razorpay_order_id">
        <input type="hidden" name="razorpay_signature" id="razorpay_signature">
        <!-- <?php echo $this->Form->control('address_id',['type' => 'radio','options' => $Address, 'required' => 'required','checked']); ?> -->
        <div style="display: flex;flex-wrap: wrap;">
            <?php foreach ($Address as $key => $Addres) { ?>
                <span style="width: 20%; display: flex; align-items: center; padding:5PX 15px; margin: 10px 0; ">
                    <input type="radio" name="address_id" value="<?php echo $Addres->id; ?>" checked><label style="margin: 0; font-size: 12px;"><?php echo $Addres->type; echo '<br>';?><strong style="font-size: 13px"><?php echo $Addres->full_name; echo '<br>';?></strong><?php echo $Addres->house_no_building; echo ', '; echo $Addres->area; echo ', '; echo $Addres->lendmark; echo ', '; echo $Addres->city; echo ', '; echo $Addres->state; echo ', '; echo $Addres->pin_code; echo '<br>'; echo $Addres->country; ?></label>
                </span>
            <?php } ?>
        </div>
    <?= $this->Form->end() ?>

<button id="rzp-button1">Pay</button>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
    var options = {
        "key": "<?php echo $paymentSetings['razorpay_key_id']; ?>", // Enter the Key ID generated from the Dashboard
        "amount": "<?php echo $razorpayOrder->amount; ?>", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
        "currency": "INR",
        "name": "Acme Corp",
        "description": "Test Transaction",
        "image": "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTm_lqlRagVwXOHSkof6FKLEm1JCWqNMDFXcg&usqp=CAU",
        "order_id": "<?php echo $razorpayOrder->id; ?>", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
        "handler": function (response){
            //set hidden field
            $('#razorpay_payment_id').val(response.razorpay_payment_id);
            $('#razorpay_order_id').val(response.razorpay_order_id);
            $('#razorpay_signature').val(response.razorpay_signature);
            // console.log(response.razorpay_payment_id);
            // console.log(response.razorpay_order_id);
            // console.log(response.razorpay_signature);
            $('#payment_form').submit();
        },
        "prefill": {
            "name": '<?php echo $Customers['name']; ?>',
            "email": '<?php echo $Customers['email']; ?>',
            "contact": '<?php echo $Customers['phonenumber']; ?>',
        },
        // "notes": {
        //     "address": "Razorpay Corporate Office"
        // },
        "theme": {
            "color": "#3399cc"
        }
    };
    var rzp1 = new Razorpay(options);
    rzp1.on('payment.failed', function (response){
            console.log(response.error.code);
            console.log(response.error.description);
            console.log(response.error.source);
            console.log(response.error.step);
            console.log(response.error.reason);
            console.log(response.error.metadata.order_id);
            console.log(response.error.metadata.payment_id);
    });
    document.getElementById('rzp-button1').onclick = function(e){
        rzp1.open();
        e.preventDefault();
    }
</script>