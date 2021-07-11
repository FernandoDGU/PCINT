var precio_total = $("#precioTotal").text();

paypal.Buttons({
    style:{
        color:'blue',
        shape:'pill'
    },
    createOrder:function(data, actions){
return actions.order.create({
    purchase_units:[{
        amount:{
            value: precio_total
                }
            }]
        });
    },
    onApprove: function(data, actions){
        return actions.order.capture().then(function (details){
            console.log(details)
            comprarCursos()
        })
    }
}).render('#paypal-payment-button');