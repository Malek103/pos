// const search = document.querySelector('.search');
// // async function postData(url = '') {

// //     const response = await fetch(url, {
// //         method: 'get', // *GET, POST, PUT, DELETE, etc.
// //         mode: 'cors', // no-cors, *cors, same-origin
// //         cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
// //         credentials: 'same-origin', // include, *same-origin, omit
// //         headers: {
// //             'Content-Type': 'application/json'
// //             // 'Content-Type': 'application/x-www-form-urlencoded',
// //         },
// //         redirect: 'follow', // manual, *follow, error
// //         referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
// //         success: function (response) {
// //             console.log(response)
// //         }
// //     });
// //     // return response.json(); // parses JSON response into native JavaScript objects
// // }

// // search.addEventListener('keyup', e => {
// //     let searchName = e.target.value
// //     let url = "http://127.0.0.1:8000/definition/" + searchName
// //     postData(url).then(data => {
// //         let item = {
// //             'clients': data.name
// //         }
// //         console.log(item)

// //     })
// // })

// search.addEventListener('keyup', e => {
//     let searchName = e.target.value

//     fetchclient();
//     function fetchclient() {
//         $.ajax({
//             type: 'GET',
//             url: "http://127.0.0.1:8000/definition/" + searchName,

//             dataType: "json",
//             success: function (response) {
//                 console.log(response.clients)
//             }

//         });

//     }
// })

// // $(document).ready(function () {
// //     fetchclient();
// //     function fetchclient() {
// //         $.ajax({
// //             type: 'GET',
// //             url: "http://127.0.0.1:8000/definition/",
// //             dataType: "json",
// //             success: function (response) {
// //                 console.log(response)
// //             }
// //         });
// //     }
// // })


