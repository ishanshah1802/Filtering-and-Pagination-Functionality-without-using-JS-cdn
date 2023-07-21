<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interview Task</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>

    <?php
    if (isset($_POST["search_start_date"])) {
        $search_start_date = $_POST["search_start_date"];
        echo "<input id='search_start_date_filter' type='hidden' value='" . $search_start_date . "'>";
    } else {
        echo "<input id='search_start_date_filter' type='hidden' value=''>";
    }

    if (isset($_POST["search_end_date"])) {
        $search_end_date = $_POST["search_end_date"];
        echo "<input id='search_end_date_filter' type='hidden' value='" . $search_end_date . "'>";
    } else {
        echo "<input id='search_end_date_filter' type='hidden' value=''>";
    }

    if (isset($_POST["employee_category"])) {
        $employee_category = $_POST["employee_category"];
        echo "<input id='employee_category_filter' type='hidden' value='" . $employee_category . "'>";
    } else {
        echo "<input id='employee_category_filter' type='hidden' value=''>";
    }

    if (isset($_POST["financial_year"])) {
        $financial_year = $_POST["financial_year"];
        echo "<input id='financial_year_filter' type='hidden' value='" . $financial_year . "'>";
    } else {
        echo "<input id='financial_year_filter' type='hidden' value=''>";
    }

    ?>
    <h3 class="text-center mt-5">Pagination and Filtering without using JS CDN</h3>
    <div class="container">
        <div class="search">
            <form action="index.php" method="POST">
                <div class="row ms-1 mt-5" id="tbody_id2">
                    <div class="col-md-1"></div>
                    <div class="col-md-2">
                        <label for="search_start_date"> Start Date </label>
                        <input type="date" class="form-control" name="search_start_date" id="search_start_date" placeholder="Select Date" value="<?php if (isset($search_start_date)) echo $search_start_date; ?>">
                    </div>

                    <div class="col-md-2">
                        <label for="search_end_date"> End Date </label>
                        <input type="date" class="form-control" name="search_end_date" id="search_end_date" placeholder="Select Date" value="<?php if (isset($search_end_date)) echo $search_end_date; ?>">
                    </div>

                    <div class=" col-md-2">
                        <label for="employee_category"> Employee Category </label>
                        <select type="" class="form-select" name="employee_category" id="employee_category">
                            <option value="" <?php if (!isset($employee_category))  echo "selected";  ?>>All</option>
                            <option value='Part-time' <?php if (isset($employee_category))  if ($employee_category == 'Part-time')  echo "selected";  ?>>Part Time</option>
                            <option value='Full-time' <?php if (isset($employee_category))  if ($employee_category == 'Full-time')  echo "selected";  ?>>Full Time</option>
                            <option value='Intern' <?php if (isset($employee_category))  if ($employee_category == 'Intern')  echo "selected";  ?>>Intern</option>
                        </select>
                    </div>

                    <div class=" col-md-2">
                        <label for="financial_year"> Financial Year </label>
                        <select type="" class="form-select" name="financial_year" id="financial_year">
                            <option value="" <?php if (!isset($financial_year))  echo "selected";  ?>>All</option>
                            <option value='TY' <?php if (isset($financial_year))  if ($financial_year == 'TY')  echo "selected";  ?>>This Year</option>
                            <option value='LY' <?php if (isset($financial_year))  if ($financial_year == 'LY')  echo "selected";  ?>>Last Year</option>
                        </select>
                    </div>

                    <div class="col-2 align-items-center mt-4">
                        <button class="btn btn-primary btn-block rounded-pill dt-submit" id="submit">Submit</button>
                        <button class="btn btn-info btn-block rounded-pill" id="clear">Clear</button>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <div class="container my-5">
        <div class="row">
            <div class="col-md-3 offset-md-9">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="search">Search: </label>
                    </div>
                    <input type="text" id="search" class="form-control" placeholder="Search data" name="search">
                </div>
            </div>
        </div>
        <div class="container my-5">
            <table class="table">
                <thead id="thead_show">
                    <tr>
                        <th>Employee ID</th>
                        <th>Employee Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Employee Category</th>
                    </tr>
                </thead>
                <tbody id="tbody_show"></tbody>
            </table>
            <div class="row">
                <div class="col-md-6 mt-2">
                    <p id="entries"></p>
                </div>
                <div class="col-md-6">
                    <div class="pagination-div"></div>
                </div>
            </div>
        </div>
    </div>

    <section>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="index.js"></script>
    </section>
</body>

</html>