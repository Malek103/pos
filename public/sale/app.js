// var i = 0;
// let total = 0
// const itemArr = []
// let index = 1;
// const order = document.querySelector('.pos-content-container');
// const tab = document.querySelector('#newOrderTab')


// async function postData(url = '') {

//     const response = await fetch(url, {
//         method: 'get', // *GET, POST, PUT, DELETE, etc.
//         mode: 'cors', // no-cors, *cors, same-origin
//         cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
//         credentials: 'same-origin', // include, *same-origin, omit
//         headers: {
//             'Content-Type': 'application/json'
//             // 'Content-Type': 'application/x-www-form-urlencoded',
//         },
//         redirect: 'follow', // manual, *follow, error
//         referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
//     });
//     if (response['status'] == 404) {
//         tempAlert('الباركود المدخل غير موجود', 1000)
//         return null;
//     }
//     return response.json(); // parses JSON response into native JavaScript objects
// }

// function addTab(item, tab) {
//     let child = `   <div class="pos-order">
//                     <div class="pos-order-product">
//                         <div class="img"
//                           //  style="background-image: url({{ asset('images/defult.png') }})">
//                         </div>
//                         <div class="flex-1">
//                             <div class="h3 mb-1 text-right" name="additem[${i}][name]"> ${item.name} : اسم المنتج</div>
//                             <div class="h4 text-right" name="additem[${i}][price]">₪ ${item.price}     : سعر المنتج </div>

//                             <div class="d-flex">
//                                 <a href="#" onclick="subQty(${item.id})" class="btn btn-outline-theme btn-sm"><i class="fa fa-minus"></i></a>
//                                 <input name="additem[${i}][quantity]" id="qty${item.id}" type="number" min="0" step="1" readonly
//                                     class="form-control w-25px form-control-sm mx-2 bg-white bg-opacity-25 bg-white bg-opacity-25 text-center"
//                                     value="${item.qty}" onChange="update"/>
//                                 <a href="#" onclick="addQty(${item.id})" class="btn btn-outline-theme btn-sm"><i class="fa fa-plus"></i></a>

//                             </div>
//                             <i id="${item.id}"class="fa fa-trash delete"></i>
//                         </div>
//                     </div>
//                     <div class="pos-order-price text-center">
//                         ${item.qty * item.price}
//                     </div>


//                 </div>
//                 <hr>`

//     tab.innerHTML += child
// }

// function addQty(item, index) {
//     let uId = "qty" + item
//     let updateQty = document.getElementById(uId)
//     updateQty.value++

// }

// function subQty(item) {
//     let uId = "qty" + item
//     let updateQty = document.getElementById(uId)
//     if (updateQty.value > 1) {
//         updateQty.value--

//     }

// }
// order.addEventListener('click', e => {
//     if (e.target.classList.contains('imgs')) {
//         let parent = e.target.parentElement;
//         const id = parent.querySelector('.id').innerHTML
//         let url = "http://127.0.0.1:8000/products/" + id
//         postData(url).then(data => {
//             let item = {
//                 'id': data.id,
//                 'name': data.name,
//                 'price': data.price,
//                 'qty': 1
//             }
//             let found = false
//             let index = null
//             itemArr.forEach(function (item, key) {
//                 if (item.id == id) {
//                     found = true
//                     index = key
//                 }
//             })
//             if (found) {
//                 itemArr[index].qty++
//                 addQty(item.id)
//                 tab.innerHTML = null
//                 itemArr.forEach(function (item, key) {
//                     addTab(item, tab)
//                 })
//             } else {
//                 itemArr.push(item)
//                 tab.innerHTML = null
//                 itemArr.forEach(function (item, key) {
//                     addTab(item, tab)
//                     i++
//                 })
//             }
//             total += item.price * item.qty;

//             document.getElementById('total').innerHTML = total
//             // console.log(total);
//             sumTotal()
//             //

//         })

//     }
// })
// const search = document.getElementById("search");
// search.addEventListener('change', e => {
//     const barcode = search.value
//     let url = "http://127.0.0.1:8000/barcode/" + barcode
//     postData(url).then(data => {
//         if (data) {
//             let item = {
//                 'id': data.id,
//                 'name': data.name,
//                 'price': data.price,
//                 'qty': 1,
//                 'barcode': data.barcode,
//             }
//             let found = false
//             let index = null
//             itemArr.forEach(function (item, key) {

//                 if (item.barcode == barcode) {
//                     found = true
//                     index = key
//                 }
//             })
//             if (found) {
//                 itemArr[index].qty++
//                 addQty(item.id)
//                 tab.innerHTML = null
//                 itemArr.forEach(function (item, key) {
//                     addTab(item, tab)
//                 })
//             } else {
//                 itemArr.push(item)
//                 tab.innerHTML = null
//                 itemArr.forEach(function (item, key) {
//                     addTab(item, tab)
//                 })

//             }
//             total += item.price * item.qty;

//             document.getElementById('total').innerHTML = total
//             // console.log(total);
//             sumTotal()

//         }
//         search.value = null
//     })


// })
// tab.addEventListener('click', e => {
//     if (e.target.classList.contains('delete')) {
//         let dId = e.target.id
//         itemArr.forEach(function (item, key) {
//             if (item.id == dId) {

//                 let price = item.price * e.target.parentElement.querySelector('#qty' + dId).value
//                 // console.log(price)
//                 itemArr.splice(key - 1, 1)
//                 total -= price
//                 document.getElementById('total').innerHTML = total
//                 e.target.parentElement.remove()
//             }

//         })
//     }
// })

// function sumTotal() {
//     let disconunt = document.getElementById('discount').value
//     let orderSum = total - disconunt
//     document.getElementById('sumtotal').innerHTML = orderSum
// }

// function tempAlert(msg, duration) {

//     var el = document.createElement("h1");
//     el.setAttribute("style",
//         "position:absolute;top:1rem;right:10rem;background-color:#ff3347;color:white;font-size:1.5rem;padding:2rem;align-text:center;z-index: 9999 !important;"
//     );
//     el.innerHTML = msg;
//     document.body.appendChild(el);
//     setTimeout(function () {
//         el.parentNode.removeChild(el);
//     }, duration);
//     var audio = new Audio('../../../voice/alert.wav').play();
// }
