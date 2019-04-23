function cartQuantityEvent()
{
    var elements = document.getElementsByClassName("quantity-add");
    for(i=0;i<elements.length;i++)
    {
        elements[i].addEventListener("click",function(event){
            var qtys = this.parentElement.getElementsByClassName("quantity-number");
            for(ii=0;ii<qtys.length;ii++)
            {
                var qty = Number(qtys[ii].value) + 1;
                if(qty>0)
                {
                    qtys[ii].value = qty;
                }
                else
                {
                    qtys[ii].value = 1;
                }
            }
        });
    }

    var elements = document.getElementsByClassName("quantity-subtract");
    for(i=0;i<elements.length;i++)
    {
        elements[i].addEventListener("click",function(event){
            var qtys = this.parentElement.getElementsByClassName("quantity-number");
            for(ii=0;ii<qtys.length;ii++)
            {
                var qty = Number(qtys[ii].value) - 1;
                if(qty>0)
                {
                    qtys[ii].value = qty;
                }
                else
                {
                    qtys[ii].value = 1;
                }
            }
        });
    }
}

function formAddCart(objForm)
{
    objForm.removeEventListener("submit",function(){});

    objForm.addEventListener("submit",function(event){
    event.preventDefault();
    var data = new FormData(objForm);
        if(data.get('qty')>0)
        { 
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function()
            {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        loadCart();
                        
                    } else {
                        if (error)
                            error(xhr);
                    }
                }
            };
            xhr.open("POST", '/?route=purchase/addToCart', true);
            xhr.send(data);
        }
    });
}

function formRemoveCart(objForm)
{
    objForm.removeEventListener("submit",function(){});
    objForm.addEventListener("submit",function(event){
        event.preventDefault();
        var data = new FormData(this);
            if(data.get('qty')>0)
            { 
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function()
                {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            loadCart();
                            
                        } else {
                            if (error)
                                error(xhr);
                        }
                    }
                };
                xhr.open("POST", '/?route=purchase/removeFromCart', true);
                xhr.send(data);
            }
        });
}

function cartEvents()
{
    var elements =document.getElementsByClassName('cart-forms-add'); 
    for(i=0;i<elements.length;i++)
    {   
        formAddCart(elements[i]);
    }  
    
    var elements =document.getElementsByClassName('cart-forms-sub'); 
    for(i=0;i<elements.length;i++)
    {
        formRemoveCart(elements[i]);
    }  
}


function removeFromCart(id)
{
    document.getElementById(id).addEventListener("submit", function(event){
        event.preventDefault();
        var form = document.getElementById(id);
        var data = new FormData(form);
        
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function()
        {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    loadCart();
                    if (success)
                        success(JSON.parse(xhr.responseText));
                        
                } else {
                    if (error)
                        error(xhr);
                }
            }
        };
        xhr.open("POST", '/?route=purchase/removeFromCart', true);
        xhr.send(data);
        xhr.success = function(){}

        });
}

function loadCart()
{
    loadJSON('/?route=profile/cart',
            function(data)
            { 
                setCartTotal("cart-total",data.total);
                iterateCart("cart-items",data.items);
                reloadFunds("cart-funds",data.funds);
            },
            function(xhr) 
            { 
                console.error(xhr); 
            }
    );

}

function reloadFunds(id, funds)
{
    var el = document.getElementById(id);
    el.innerHTML=funds;
}

function setCartTotal(id, total)
{
    var el = document.getElementById(id);
    el.innerHTML="$ " + total;
}

function iterateCart(id, data)
{
    var elements =document.getElementsByClassName('cart-forms-add'); 
    for(i=0;i<elements.length;i++)
    {
        elements[i].removeEventListener("submit",function(){});
    }
    var elements =document.getElementsByClassName('cart-forms-sub'); 
    for(i=0;i<elements.length;i++)
    {
        elements[i].removeEventListener("submit",function(){});
    }

        var el = document.getElementById(id);
        while (el.firstChild) {
        el.removeChild(el.firstChild);
    }
        if(Object.keys(data).length > 0)
        {
        data.forEach(element => {
            var tr = document.createElement("tr");
            var td0 = document.createElement("td");
            td0.innerHTML = element['name'];
            
            var td1 = document.createElement("td");
            td1.innerHTML = "$ "+element['price'];
            td1.align = "right";
            var td2 = document.createElement("td");
            td2.innerHTML = '<form method="post" action="/?route=purchase/removeFromCart" class="cart-forms-sub"><input type="hidden" name="qty" value=1><input type="hidden" name="product_id" value='+element['product_id']+'><button>-</button></form>'+element['quantity']+'<form method="post" action="/?route=purchase/addToCart"  class="cart-forms-add"><input type="hidden" name="qty" value="1"><input type="hidden" name="product_id" value='+element['product_id']+'><button>+</button></button>';

            var tmps = td2.getElementsByClassName("cart-forms-sub");
            for(i= 0;i<tmps.length;i++)
            {
                formRemoveCart(tmps[i]);
            }
            
            var tmpa = td2.getElementsByClassName("cart-forms-add");
            for(i= 0;i<tmpa.length;i++)
            {
                formAddCart(tmpa[i]);
            }
            td2.align = "center";
            var td3 = document.createElement("td");
            td3.innerHTML = "$ "+element['subtotal'];
            td3.align = "right";

            tr.append(td0);
            tr.append(td1);
            tr.append(td2);
            tr.append(td3);
            el.append(tr);
        });


        
        }
        else
        {
        var tr = document.createElement("tr");
        var td = document.createElement("td");
        td.colSpan = 4;
        td.innerHTML = "No Item on Cart.";
        td.align = "center";
        tr.append(td);
        el.append(tr);
        }
}

function checkout(id)
{
    document.getElementById(id).addEventListener("submit",function(event){
        event.preventDefault();
        var data = new FormData(document.getElementById(id));
        

        var items = document.getElementById("cart-items").firstChild.childElementCount;
        if(items < 4)
        {
            alert("No items on the cart...");
        }
        else
        {
            if(data.get("shipping")==null)
            {
                alert("Please select the mode of shipment.");
            }
            else
            {
                
                var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function()
                    {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                loadCart();
                                alert("Purchase Sucessfull!");
                            } else {
                            }
                        }
                    };
                    xhr.open("POST", '/?route=purchase/checkout', true);
                    xhr.send(data);
            }
        }

    });
}

function loadJSON(path, success, error)
{
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function()
    {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                if (success)
                    success(JSON.parse(xhr.responseText));
            } else {
                if (error)
                    error(xhr);
            }
        }
    };
    xhr.open("GET", path, true);
    xhr.send();
}
function loadRate()
{
    var elements =document.getElementsByClassName('rate-product'); 
    for(i=0;i<elements.length;i++)
    {
        elements[i].addEventListener("submit",function(event){
            var data = new FormData(elements[i]);

            if(data.get('rate') == 0)
            {
                event.preventDefault();
                alert("You had to select rating from 1 to 5.");
            }

        });
    }

}