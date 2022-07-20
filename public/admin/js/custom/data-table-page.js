 /*---------------------------
 DataTable page
 ---------------------------*/
 //customers table
 $('#customers-table').DataTable({
    //"paging": false,
    "info": false,
    //searching: false,
    language: {
        searchPlaceholder: "Type..."
    }
});

//project list table
$('#project-list-table').DataTable({
    //"paging": false,
    "info": false,
    //searching: false,
    language: {
        searchPlaceholder: "Type..."
    }
});

//filter table
$('#filter-table').DataTable({
    "paging": false,
    "info": false,
    searching: false,
    language: {
        searchPlaceholder: "Type..."
    }
});