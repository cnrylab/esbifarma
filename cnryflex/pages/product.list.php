<?php require dirname(__FILE__, 3).'/root.php';
require dirFlex.'system/core.php';
$core = new Core('private');
$core->open(
    array('p_product', 'List of Products'),
    array('lib/dataTables', 'lib/select2', 'lib/jquery-ui', 'lib/buttons.dataTables', 'tables'),
    array('lib/dataTables', 'lib/select2', 'lib/jquery-ui', 'lib/dataTables.buttons', 'lib/datetime-moment', 'lib/buttons.html5', 'lib/jszip')
); ?>

<section class="top">
    <div id="actions" privil="<?php echo $core->privileges('p_product', 'list') ?>">
        <a class="add" style="background: var(--blue2)" href='javascript:void(0)'>
        <i class="micon">add</i>Add</a>

        <a class="edit" style="background: var(--yellow2)" href='javascript:void(0)'>
        <i class="micon">edit</i>Edit</a>

        <a class="delete" style="background: var(--red2)" href='javascript:void(0)'>
        <i class="micon">delete</i>Delete</a>

        <a class="export" style="background: var(--green2)" href='javascript:void(0)'>
        <i class="micon">table_view</i>Export</a>
    </div>

    <table id="mainTable" class="cell-border stripe responsive nowrap" style="width: 100%">
        <caption>List of Products</caption>
        <thead>
            <tr>
                <th scope='col'>Detail</th>
                <th scope='col'>ID Product</th>
                <th scope='col'>Categories</th>
                <th scope='col'>Name</th>
                <th scope='col'>Efficacy</th>
                <th scope='col'>Weight</th>
                <th scope='col'>Stock</th>
                <th scope='col'>Price</th>
                <th scope='col'>Discount</th>
                <th scope='col'>Discount For</th>
                <th scope='col'>Discount Deadline</th>
                <th scope='col'>Exclusive For</th>
                <th scope='col'>Description</th>
                <th scope='col'>Visibility</th>
                <th scope='col'>Last Modified</th>
            </tr>
        </thead>
    </table>

    <script>
        var dateToday = new Date();
        $(".datepicker input").datepicker({dateFormat: 'dd M yy', changeMonth: true, changeYear: true, minDate: dateToday});

        $.fn.dataTable.moment("MMMM Do YYYY, H:mm:ss");
        let mainTable = $("#mainTable").DataTable({
            responsive: true,
            dom: 'Bfrtip',
            buttons: ['excel'],
            "language": {
                "search": "Search: ",
                "searchPlaceholder": "Insert keyword..."
            },
            data: [],
            order: [[ 2, 'desc' ]],
            "columns": [
                {data: null,
                    defaultContent: '',
                    className: 'control',
                    orderable: false
                },
                {data: 'idPro', className: 'thisId'},
                {data: 'category'},
                {data: 'name'},
                {data: 'efficacy', className: 'none'},
                {data: 'weight'},
                {data: 'stock'},
                {data: 'price'},
                {data: 'discount'},
                {data: 'discountFor', className: 'none'},
                {data: 'discountEnd', className: 'none'},
                {data: 'exclusiveFor', className: 'none'},
                {data: 'desc', className: 'none align-left wrapok', 
                    render: function(data){
                        return (data) ? data : "<i class='micon'>more_horiz</i>";
                    }
                },
                {data: 'visibility',
                    render: function(data){
                        return(data == 'y') ? 'Visible' : 'Hidden'
                    }
                },
                {data: 'modified',
                    render: function(data){
                        return moment(new Date(data)).format("MMMM Do YYYY, H:mm:ss");
                    }
                }
            ]
        });

        function tableContents(){
            if(navigator.onLine){
                $.ajax({
                    type: "POST",
                    url: host + 'system/process/product/list',
                    complete: function(data){
                        mainTable.clear();
                        mainTable.rows.add(data.responseJSON.data).draw();
                        localStorage.setItem("product/list", JSON.stringify(data));
                    }
                });
            } else {
                mainTable.clear();
                $(".add, .edit, .delete").hide();
                var resources = JSON.parse(localStorage.getItem("product/list"));
                mainTable.rows.add(resources.responseJSON.data).draw();
            }
        }

        tableContents();
        $('.export').click(function(){
            $('.buttons-excel').click();
        });
    </script>

<?php $core->close();