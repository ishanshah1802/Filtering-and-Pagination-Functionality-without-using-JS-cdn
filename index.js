var page_number;
var search = "";
var pages;

$(document).ready(function(){
    page_number = 1;
    api_call(page_number, search);
});

$(document).on("click", ".pagination-div .pagination-nav .page-item .numbers",function(){
    page_number = $(this).data("number_track");
    console.log(page_number);
    api_call(page_number, search);
});

$(document).on("click", ".pagination-div .pagination-nav .page-item .previous-page", function () {
    if (page_number > 1) {
        page_number--;
        api_call(page_number, search);
    }
});

$(document).on("click", ".pagination-div .pagination-nav .page-item .next-page", function () {
    if (page_number < pages) {
        page_number++;
        // if(page_number == pages){
        //     $("#previous").prop("disabled", false);
        //     $("#next").addClass("disabled");
        // } else{
        //     $("#next").removeClass("disabled");
        //     $("#previous").removeClass("disabled");
        // }
        api_call(page_number, search);
    }
});

$("#search").on("change keyup", function(){
    search = $("#search").val();
    api_call(page_number, search);
});

$("#clear").on("click", function () {
    $("#search_start_date").val("");
    $("#search_end_date").val("");
    $("#employee_category").val("");
    $("#financial_year").val("");
});

function api_call(page_number, search){
    // console.log(page_number);
    // console.log(search);
    var search_start_date = $("#search_start_date_filter").val();
    var search_end_date = $("#search_end_date_filter").val();
    var employee_category = $("#employee_category_filter").val();
    var financial_year = $("#financial_year_filter").val();

    $.ajax({
        url: "query.php",
        type: "POST",
        data: {
            page_number: page_number,
            search: search,
            search_start_date: search_start_date,
            search_end_date: search_end_date,
            employee_category: employee_category,
            financial_year: financial_year
        },
        success: function (data) {
            var result = JSON.parse(data);
            $("#tbody_show").empty();
            $(".pagination-div .pagination-nav").remove();
            if (result["status"] == true) {
                var data1 = result["response"];
                pages = result["pages"];
                var num_rows = result["num_rows"];
                var start = result["start"];
                var end = start + 5;
                var active_div = "";
                for (var i = 0; i < data1.length; i++) {
                    var data2 = data1[i];
                    $("#tbody_show").append(
                        "<tr><td>" +
                        data2["emp_id"] +
                        "</td><td>" +
                        data2["emp_name"] +
                        "</td><td>" +
                        data2["start_date"] +
                        "</td><td>" +
                        data2["end_date"] +
                        "</td><td>" +
                        data2["emp_category"] +
                        "</td></tr>"
                    );
                }
                $(".pagination-div").append(
                    '<nav class="pagination-nav"><ul class="pagination justify-content-end"><li class="page-item previous"><a class="page-link previous-page" href="#">Previous</a></li>'
                );
                for (var j = 0; j < pages; j++) {
                    if((j+1) == page_number){
                        active_div = "active";
                    } else{
                        active_div = " ";
                    }
                    $(".pagination-div .pagination-nav .pagination").append(
                        '<li class="page-item ' + active_div + '"><a class="page-link numbers" href="#'+ (j+1) +'" data-number_track="'+ (j+1) +'">' + (j+1) + '</a></li>'
                    );
                }
                $(".pagination-div .pagination-nav .pagination").append(
                    '<li class="page-item" id="next"><a class="page-link next-page" href="#">Next</a></li></ul></nav>'
                );
                if(end > num_rows){
                    end = num_rows;
                }
                $("#entries").text("Showing " + (start+1) + " to " + end + " of " + num_rows + " entries");
            } else{
                $("#tbody_show").append(
                    "<tr><td colspan = '5'><center>No Data Available</center></td></tr>"
                );
                $("#entries").empty();
            }
        },
    });
}