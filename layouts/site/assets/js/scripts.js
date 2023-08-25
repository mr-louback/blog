/*!
    * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2023 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
// 
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }
    
});
// console.log('ww');
// function search() {
//     document.getElementById('searchInput').addEventListener('keyup', () => {
//        var inputSearch = document.querySelector('#searchInput').value ;
//        document.getElementById('searchResults').innerText = inputSearch
//     //    console.log(inputSearch);
//     })

// }
// search() 
// $(document).ready(function () {
//     $('#searchInput').on('keyup', function () {
//         var searchText = $(this).val();
//         $.ajax({
//             url: 'search.php',
//             type: 'POST',
//             data: { searchText: searchText },
//             success: function (response) {
//                 $('#searchResults').html(response);
//             }
//         })
//     })
// })