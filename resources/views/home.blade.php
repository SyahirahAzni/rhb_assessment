<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <!-- <script src="/vendor/twbs/pagination/jquery.twbsPagination.min.js"></script> -->

    <title>Front-end Assessment</title>
  </head>
  <body>
    <div class="container">
      <input class="form-control mt-4 mb-4" type="" name="search" id="search" placeholder="Search">
      <h6 class="font-weight-bold" name="total" id="total">{items->total_count} repository results</h4>
      <hr align="left" width="100%">

      <div class="row m-0">
        <div class="col-lg-8 p-0">
          <h5 name="full_name" id="full_name" class="text-info font-weight-bold">$item->full_name</h5>
          <p name="description" id="description">A declarative, efficient and flexible JavaScript library for building user interfaces.</p>
          <p name="updated_date" id="updated_date">Updated on Tue,Jul 03 2018</p>
        </div>
        <div class="col-lg-4">
          <div class="d-flex justify-content-between">
            <label name="language" id="language"><i class="fa fa-circle mr-1"></i>JavaScript</label>
            <label name="star" id="star"><i class="fa fa-star mr-1"></i>105262</label>
          </div>
        </div>
        <hr align="" width="100%">
      </div>

      <!-- pagination -->
      <div id="pager">
            <ul id="pagination" class="pagination-sm"></ul>
      </div>
      <!-- <nav aria-label="Search results pages">
        <ul class="pagination justify-content-center">
          <li class="page-item">
            <a class="page-link" href="#" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
              <span class="sr-only">Previous</span>
            </a>
          </li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item">
            <a class="page-link" href="#" aria-label="Next">
              <span aria-hidden="true">&raquo;</span>
              <span class="sr-only">Next</span>
            </a>
          </li>
        </ul>
      </nav> -->
    </div>
    
    

    <!-- Optional JavaScript -->
    <!--   then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>

  <script type="text/javascript">
    

$(document).ready(function() {

  var message = $("#search").val();
  var data = {'full_name' : message};
  var $pagination = $('#pagination'),
      totalRecords = 0,
      records = [],
      displayRecords = [],
      recPerPage = 10,
      page = 1,
      totalPages = 0;

  $('#search').keydown(function() {
    if(event.keyCode == 13){
      postRequest('https://api.github.com/search/repositories?per_page=${per_page}&q=',{full_name: message})
        .then(data => console.log(data)) // Result from the `response.json()` call
        .catch(error => console.error(error))

      function postRequest(url, data) {
        return fetch(url, {
          credentials: 'same-origin', // 'include', default: 'omit'
          method: 'post', // 'GET', 'PUT', 'DELETE', etc.
          body: JSON.stringify(data), // Coordinate the body type with 'Content-Type'
          headers: new Headers({
            'Content-Type': 'application/json'
          }),
        })
        .then(response => response.json())
      }
      // $.ajax({
      //     url: "https://api.github.com/search/repositories?per_page=${per_page}&q=",
      //     type: "post",
      //     data: data,
      //     body: JSON.stringify(data),
      //     dataType: 'application/json',
      //     success: function(){  

      //       alert("Sent");
      //     },
      //     error:function(){
      //       alert("No result");                
      //     }
      //   });
    }
  });

  function generate_table() {
      var total = $("#total");
  
      for (var i = 0; i < displayRecords.length; i++) {
            total.append(displayRecords[i].total_count);
            $('body').append(total);
            console.log(total);
      }
      
  }

  // function apply_pagination() {
  //       $pagination.twbsPagination({
  //             totalPages: totalPages,
  //             visiblePages: 6,
  //             onPageClick: function (event, page) {
  //                   displayRecordsIndex = Math.max(page - 1, 0) * recPerPage;
  //                   endRec = (displayRecordsIndex) + recPerPage;
                   
  //                   displayRecords = records.slice(displayRecordsIndex, endRec);
  //                   generate_table();
  //             }
  //       });
  // }

});


  </script>
</html>