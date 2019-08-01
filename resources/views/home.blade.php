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
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.1/jquery.twbsPagination.min.js'></script>

    <title>Front-end Assessment</title>
  </head>
  <body>
    <div class="container">
      <input class="form-control mt-4 mb-4" type="search" name="search" onclick="clear()" id="search" placeholder="Search">
      <h6 class="font-weight-bold" name="total" id="total"></h4>
      <hr id="line" align="left" width="100%">
      <div id=divitem class="row m-0">
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


    var $pagination = $('#pagination'),
    totalRecords = 0,
    records = [],
    displayRecords = [],
    recPerPage = 10,
    page = 1,
    totalPages = 0;

      $('#search').on("search", function(event) {
        $("#total").empty();
        $("#divitem").empty();
      });

      $('#search').keydown(function() {
        if(event.keyCode == 13){

          let test = $('#search').val();
          console.log(test);

          fetch('https://api.github.com/search/repositories?per_page=${per_page}&q='+test+'')
            .then(response => response.json())
            .then(data => {
              records = data.items;
              console.log(records);
              totalRecords = records.length;
              totalPages = Math.ceil(totalRecords / recPerPage);
              apply_pagination(data);
              console.log(data);
              var total = $("#total");
              total.append(data.total_count + " repository results");

            })
            .catch(error => console.error(error))
        }
      });

      function generate_table(data) {
          
      
          for (var i = 0; i < displayRecords.length; i++) {

                $('#divitem').append(
                    '<div class="col-lg-8 p-0">'+
                      '<h5 name="full_name" id="full_name" class="text-info font-weight-bold">'+displayRecords[i].full_name+'</h5>'+
                      '<p name="description" id="description">'+displayRecords[i].description+'</p>'+
                      '<p name="updated_date" id="updated_date">Updated on Tue,'+displayRecords[i].updated_at+'</p>'+
                    '</div>'+
                    '<div class="col-lg-4">'+
                      '<div class="d-flex justify-content-between">'+
                        '<label name="language" id="language"><i class="fa fa-circle mr-1"></i>'+displayRecords[i].language+'</label>'+
                        '<label name="star" id="star"><i class="fa fa-star mr-1"></i>'+displayRecords[i].stargazers_count+'</label>'+
                      '</div>'+
                    '</div>'+
                    '<hr align="" width="100%">');
          }
      }

      function clear(){

       
        console.log( $('#search').val());
      }

      function apply_pagination(data) {
        $pagination.twbsPagination({
        totalPages: totalPages,
        visiblePages: 6,
        next: 'Next',
        prev: 'Prev',
        onPageClick: function (event, page) {
                  displayRecordsIndex = Math.max(page - 1, 0) * recPerPage;
                  endRec = (displayRecordsIndex) + recPerPage;
                 
                  displayRecords = records.slice(displayRecordsIndex, endRec);
                  generate_table(data);
            }
         });
      }

    });
  </script>
</html>