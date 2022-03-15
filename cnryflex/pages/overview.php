<?php require dirname(__FILE__, 3).'/root.php';
require dirFlex.'system/core.php';
$core = new Core('private');
$core->open(
    array('p_overview', 'Overview'),
    array(),
    array('lib/chart')
); ?>

<section id="overview" class="top">
    <span class="title">Overview.</span>
    
    <div class="total">
        <a class="item" href="<?php echo urlFlex ?>pages/order.list">
            <i class="micon">receipt_long</i>
            <span class="title">Orders</span>
            <div class="bottom">
                <span class="result">0</span>
                <span class="seeMore">See More</span>
            </div>
        </a>

        <a class="item" href="<?php echo urlFlex ?>pages/product.list">
            <i class="micon">spa</i>
            <span class="title">Products</span>
            <div class="bottom">
                <span class="result"><?php echo mysqli_num_rows($core->data->query("SELECT `created` FROM `tb_products`")) ?></span>
                <span class="seeMore">See More</span>
            </div>
        </a>

        <a class="item" href="<?php echo urlFlex ?>pages/customer.list">
            <i class="micon">supervised_user_circle</i>
            <span class="title">Customers</span>
            <div class="bottom">
                <span class="result"><?php echo mysqli_num_rows($core->data->query("SELECT `created` FROM `tb_customers`")) ?></span>
                <span class="seeMore">See More</span>
            </div>
        </a>

        <a class="item" href="<?php echo urlFlex ?>pages/customer.list">
            <i class="micon">badge</i>
            <span class="title">Partnership</span>
            <div class="bottom">
                <span class="result"><?php echo mysqli_num_rows($core->data->query("SELECT `created` FROM `tb_customers` WHERE `idLevel`")) ?></span>
                <span class="seeMore">See More</span>
            </div>
        </a>
    </div>

    <div class="chart">
        <div class="left">
            <span class="title">38</span>
            <span class="tagline">Total website visitors today</span>
            <span class="desc">Graph of the number of website visitors for the last 3 days. To see the complete data click the button below.</span><a href="<?php echo urlFlex ?>pages/pageview.list">See entire data<i class='micon'>east</i></a>
        </div>
        <div class="right"><canvas id="ikhtisar1"></canvas></div>
    </div>

    <script>
        var ctx = document.getElementById("ikhtisar1").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: { labels: ["Sunday", "Tuesday", "Wednesday"],
                datasets: [{
                    label: 'Return',
                    data: [4, 6, 10],
                    backgroundColor: '#345EFF'
                }, {
                    label: 'Waiting',
                    data: [2, 4, 14],
                    backgroundColor: '#999'
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                plugins: {
                    legend: {
                        labels: {
                            font: {
                                size: 11,
                                weight: 300,
                                family: "Poppins"
                            }
                        }
                    }
                }
            }
        });
    </script>

<?php $core->close();