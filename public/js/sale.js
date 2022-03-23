var i = 0;
let total = 0
const itemArr = []
let index = 1;
const order = document.querySelector('.pos-content-container');
const tab = document.querySelector('#newOrderTab')



async function postData(url = '') {

    const response = await fetch(url, {
        method: 'get', // *GET, POST, PUT, DELETE, etc.
        mode: 'cors', // no-cors, *cors, same-origin
        cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
        credentials: 'same-origin', // include, *same-origin, omit
        headers: {
            'Content-Type': 'application/json'
            // 'Content-Type': 'application/x-www-form-urlencoded',
        },
        redirect: 'follow', // manual, *follow, error
        referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
    });
    if (response['status'] == 404) {
        tempAlert('الباركود المدخل غير موجود', 1000)
        return null;
    }
    return response.json(); // parses JSON response into native JavaScript objects
}

function addTab(item, tab) {
    let child = `   <div class="pos-order">
                    <div class="pos-order-product">
                        <div class="img"
                          //  style="background-image: url({{ asset('images/defult.png') }})">
                        </div>
                        <div class="flex-1">
                            <div class="h3 mb-1 text-right" name="additem[${i}][name]"> ${item.name} : اسم المنتج</div>
                            <div class="h4 text-right" name="additem[${i}][price]">₪ ${item.price}     : سعر المنتج </div>

                            <div class="d-flex">
                                <a href="#" onclick="calcQty(${item.id}, true)" class="btn btn-outline-theme btn-sm"><i class="fa fa-minus"></i></a>
                                <input name="additem[${i}][quantity]" id="qty${item.id}" type="number" min="0" step="1" readonly
                                    class="form-control w-25px form-control-sm mx-2 bg-white bg-opacity-25 bg-white bg-opacity-25 text-center"
                                    value="${item.qty}" onChange="update"/>
                                <a href="#" onclick="calcQty(${item.id})" class="btn btn-outline-theme btn-sm"><i class="fa fa-plus"></i></a>

                            </div>
                            <i id="${item.id}"class="fa fa-trash delete"></i>
                            <div id="itemtotal" class="pos-order-price text-center">
                        ${item.qty * item.price}
                    </div><hr>
                        </div>
                    </div>



                </div>
                `

    tab.innerHTML += child
}
function calcQty(item, sub = null) {
    let uId = "qty" + item
    let updateQty = document.getElementById(uId)
    // console.log(updateQty.value)
    // if (updateQty.value >= 2) {
    let found = false
    let index = null
    let findItem
    itemArr.forEach(function (value, key) {
        if (value.id == item) {
            found = true
            index = key
            findItem = value
        }
    })

    checkItem(found, findItem, index, sub)
}
// else {
//     tempAlert('لا يمكن بيع منتج عدده صفر', 1000)
// }
// }
function addQty(item) {
    let uId = "qty" + item
    let updateQty = document.getElementById(uId)
    updateQty.value++
    // console.log(updateQty.value++)

}

function subQty(item) {
    let uId = "qty" + item
    let updateQty = document.getElementById(uId)
    updateQty.value--
}
order.addEventListener('click', e => {
    if (e.target.classList.contains('imgs')) {
        let parent = e.target.parentElement;
        const id = parent.querySelector('.id').innerHTML
        let url = "http://127.0.0.1:8000/products/" + id
        postData(url).then(data => {
            let item = {
                'id': data.id,
                'name': data.name,
                'price': data.price,
                'qty': 1,
                'cost': data.cost

            }
            let found = false
            let index = null
            itemArr.forEach(function (item, key) {
                if (item.id == id) {
                    found = true
                    index = key
                }
            })
            checkItem(found, item, index)

        })

    }
})
const search = document.getElementById("search");
search.addEventListener('change', e => {
    const barcode = search.value
    let url = "http://127.0.0.1:8000/barcode/" + barcode
    postData(url).then(data => {
        if (data) {
            let item = {
                'id': data.id,
                'name': data.name,
                'price': data.price,
                'qty': 1,
                'cost': data.cost,
                'barcode': data.barcode,
            }
            let found = false
            let index = null
            itemArr.forEach(function (item, key) {

                if (item.barcode == barcode) {
                    found = true
                    index = key
                }

            })
            checkItem(found, item, index)

        }
        search.value = null
    })


})
function checkItem(found, item, index, sub = null) {
    if (found) {
        if (sub) {
            itemArr[index].qty--
            subQty(item.id)
        } else {
            itemArr[index].qty++
            addQty(item.id)
        }


        tab.innerHTML = null
        itemArr.forEach(function (item, key) {
            addTab(item, tab)
        })
    } else {
        itemArr.push(item)
        tab.innerHTML = null
        itemArr.forEach(function (item, key) {
            addTab(item, tab)
        })

    }
    if (sub) {

        total -= item.price;

    } else {

        total += item.price;


    }

    document.getElementById('total').innerHTML = total
    sumTotal()

}
tab.addEventListener('click', e => {
    if (e.target.classList.contains('delete')) {
        let dId = e.target.id
        itemArr.forEach(function (item, key) {
            if (item.id == dId) {

                let price = item.price * e.target.parentElement.querySelector('#qty' + dId).value
                // console.log(price)
                itemArr.splice(key - 1, 1)
                total -= price
                document.getElementById('total').innerHTML = total
                // console.log(e.target.parentElement)
                e.target.parentElement.remove()
                sumTotal()
            }

        })
    }
})

function sumTotal() {
    let disconunt = document.getElementById('discount').value
    let orderSum = total - disconunt
    document.getElementById('sumtotal').innerHTML = orderSum
}

function tempAlert(msg, duration) {

    var el = document.createElement("h1");
    el.setAttribute("style",
        "position:absolute;top:1rem;right:10rem;background-color:#ff3347;color:white;font-size:1.5rem;padding:2rem;align-text:center;z-index: 9999 !important;"
    );
    el.innerHTML = msg;
    document.body.appendChild(el);
    setTimeout(function () {
        el.parentNode.removeChild(el);
    }, duration);
    var audio = new Audio('../../../voice/alert.wav').play();
}
function deleteAllItem() {
    itemArr.length = 0
    total = 0
    tab.innerHTML = null
    document.getElementById('sumtotal').innerHTML = 0
    document.getElementById('total').innerHTML = 0
}

function addOrder() {
    let client_id = document.getElementById('client_id').value
    let discount = document.getElementById('discount').value
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "http://127.0.0.1:8000/sales/",
        data: {
            "itemArr": itemArr,
            "client_id": client_id,
            "total": total,
            "discount": discount,
        },
        // success: success,
        success: function (data) {
            alert(data[1]);
        },
        dataType: "json",
        error: function (error) {
            console.log(JSON.stringify(error));
            deleteAllItem()
        }
    });


}
