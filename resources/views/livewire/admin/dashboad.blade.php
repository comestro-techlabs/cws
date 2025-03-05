<div>
    <section id="content"
        class="p-5 right-0 transition-all duration-500 ease-in-out">
        <!-- user summary -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4">
            <div class="bg-slate-50 p-5 m-2 rounded-md flex justify-between items-center shadow">
                <div>
                    <h3 class="font-bold">Total Users</h3>
                    <p class="text-gray-500">100</p>
                </div>
                <i class="fa-solid fa-users p-4 bg-gray-200 rounded-md"></i>
            </div>

            <div class="bg-slate-50 p-5 m-2 flex justify-between items-center shadow">
                <div>
                    <h3 class="font-bold">Total Active Users</h3>
                    <p class="text-gray-500">65</p>
                </div>
                <i class="fa-solid fa-users p-4 bg-green-200 rounded-md"></i>
            </div>

            <div class="bg-slate-50 p-5 m-2 flex justify-between items-center shadow">
                <div>
                    <h3 class="font-bold">Total In Active Users</h3>
                    <p class="text-gray-500">30</p>
                </div>
                <i class="fa-solid fa-users p-4 bg-yellow-200 rounded-md"></i>
            </div>

            <div class="bg-slate-50 p-5 m-2 flex justify-between items-center shadow">
                <div>
                    <h3 class="font-bold">Deleted Users</h3>
                    <p class="text-gray-500">5</p>
                </div>
                <i class="fa-solid fa-users p-4 bg-red-200 rounded-md"></i>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-2 lg:grid-cols-2">
            <!-- chart  -->
            <div class="m-2 shadow-md">
                <h2 class="text-xl p-2">Bar Chart</h2>
                <div id="chart" class="w-full "></div>
            </div>
            <!-- //user list -->
            <div class="overflow-x-auto m-2 shadow-md">
                <table class="w-full">
                    <thead class="bg-gray-100 rounded-sm">
                        <tr>
                            <th class="text-left">Avatar</th>
                            <th class="text-left">User Name</th>
                            <th class="text-left">Email</th>
                            <th class="text-left">Phone</th>
                            <th class="text-left">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>
                                <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white"
                                    src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.25&w=256&h=256&q=80"
                                    alt="">
                            </td>
                            <td>Rabiul Islam</td>
                            <td>rir.cse.71@gmail.com</td>
                            <td>+8801750009149</td>
                            <td><span
                                    class="bg-green-50 text-green-700 px-3 py-1 ring-1 ring-green-200 text-xs rounded-md">Active</span>
                            </td>
                            <td>
                                <div class="flex justify-between gap-1">
                                    <i title="Edit"
                                        class="fa-solid fa-pencil p-1 text-green-500 rounded-full cursor-pointer"></i>
                                    <i title="View"
                                        class="fa-solid fa-eye p-1 text-violet-500 rounded-full cursor-pointer"></i>
                                    <i title="Delete"
                                        class="fa-solid fa-trash p-1 text-red-500 rounded-full cursor-pointer"></i>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white"
                                    src="https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                    alt="">
                            </td>
                            <td>Rahim Mia</td>
                            <td>rahim@gmail.com</td>
                            <td>0000000000000</td>
                            <td><span
                                    class="bg-red-50 text-red-700 px-3 py-1 ring-1 ring-red-200 text-xs rounded-md">Deleted</span>
                            </td>
                            <td>
                                <div class="flex justify-between gap-1">
                                    <i title="Edit"
                                        class="fa-solid fa-pencil p-1 text-green-500 rounded-full cursor-pointer"></i>
                                    <i title="View"
                                        class="fa-solid fa-eye p-1 text-violet-500 rounded-full cursor-pointer"></i>
                                    <i title="Delete"
                                        class="fa-solid fa-trash p-1 text-red-500 rounded-full cursor-pointer"></i>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white"
                                    src="https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                    alt="">
                            </td>
                            <td>Kuddus Ali</td>
                            <td>kuddus@gmail.com</td>
                            <td>+1111111111111111</td>
                            <td><span
                                    class="bg-yellow-50 text-yellow-700 px-3 py-1 ring-1 ring-yellow-200 text-xs rounded-md">In
                                    Active</span></td>
                            <td>
                                <div class="flex justify-between gap-1">
                                    <i title="Edit"
                                        class="fa-solid fa-pencil p-1 text-green-500 rounded-full cursor-pointer"></i>
                                    <i title="View"
                                        class="fa-solid fa-eye p-1 text-violet-500 rounded-full cursor-pointer"></i>
                                    <i title="Delete"
                                        class="fa-solid fa-trash p-1 text-red-500 rounded-full cursor-pointer"></i>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white"
                                    src="https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                    alt="">
                            </td>
                            <td>Taheri</td>
                            <td>taheri@gmail.com</td>
                            <td>+67676767676767</td>
                            <td><span
                                    class="bg-yellow-50 text-yellow-700 px-3 py-1 ring-1 ring-yellow-200 text-xs rounded-md">In
                                    Active</span></td>
                            <td>
                                <div class="flex justify-between gap-1">
                                    <i title="Edit"
                                        class="fa-solid fa-pencil p-1 text-green-500 rounded-full cursor-pointer"></i>
                                    <i title="View"
                                        class="fa-solid fa-eye p-1 text-violet-500 rounded-full cursor-pointer"></i>
                                    <i title="Delete"
                                        class="fa-solid fa-trash p-1 text-red-500 rounded-full cursor-pointer"></i>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white"
                                    src="https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                    alt="">
                            </td>
                            <td>Akkas Ali</td>
                            <td>akkas@gmail.com</td>
                            <td>+45454545454565</td>
                            <td><span
                                    class="bg-yellow-50 text-yellow-700 px-3 py-1 ring-1 ring-yellow-200 text-xs rounded-md">In
                                    Active</span></td>
                            <td>
                                <div class="flex justify-between gap-1">
                                    <i title="Edit"
                                        class="fa-solid fa-pencil p-1 text-green-500 rounded-full cursor-pointer"></i>
                                    <i title="View"
                                        class="fa-solid fa-eye p-1 text-violet-500 rounded-full cursor-pointer"></i>
                                    <i title="Delete"
                                        class="fa-solid fa-trash p-1 text-red-500 rounded-full cursor-pointer"></i>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
            <!-- chart  -->
            <div class="m-2 lg:col-span-1 shadow-md">
                <h2 class="text-xl p-2">Pie Chart</h2>
                <div id="pie_chart" class="w-full"></div>
            </div>

            <!-- candle list -->
            <div class="m-2 lg:col-span-2 shadow-md">
                <h2 class="text-xl p-2">Candle Stick Chart</h2>
                <div id="candle_chart" class="w-full"></div>
            </div>
        </div>

        <div class="grid grid-cols-1">
            <!-- heatmap list -->
            <div class="m-2 shadow-md">
                <h2 class="text-xl p-2">Heatmap Chart</h2>
                <div id="heatmap_chart" class="w-full"></div>
            </div>
        </div>
    </section>
    </main>

    <footer class="bg-gray-50 p-5 bottom-0 fixed w-full">
        <p class="text-center">Copyright @2023</p>
    </footer>

    <script>
        function collapseSidebar() {
            let sidebar = document.getElementById('sidebar')
            let content = document.getElementById('content')
            let toggle = document.getElementById('toggle-button')
            let titles = sidebar.querySelectorAll('span')

            if (sidebar.classList.contains('lg:w-[240px]')) {
                //sidebar
                sidebar.classList.remove('lg:w-[240px]')
                sidebar.classList.add('w-[60px]')

                //content
                content.classList.remove('lg:w-[100wh-250px]')
                content.classList.remove('lg:ml-[240px]')
                content.classList.add('lg:w-[100wh-100px]')
                content.classList.add('ml-[60px]')

                //toggle
                toggle.classList.remove('rotate-0')
                toggle.classList.add('rotate-180')
            } else {
                //sidebar
                sidebar.classList.remove('w-[60px]')
                sidebar.classList.add('lg:w-[240px]')

                //content
                content.classList.remove('lg:w-[100wh-100px]')
                content.classList.remove('ml-[60px]')
                content.classList.add('lg:w-[100wh-250px]')
                content.classList.add('lg:ml-[240px]')

                //toggle
                toggle.classList.remove('rotate-180')
                toggle.classList.add('rotate-0')
            }
        }

        // toggle user dropdown
        function openUserDropdown() {
            document.getElementById('user-dropdown').classList.toggle('hidden')
        }
    </script>

    <script>
        var options = {
            chart: {
                height: 350,
                type: "line",
                stacked: false
            },
            dataLabels: {
                enabled: false
            },
            colors: ["#FF1654", "#247BA0"],
            series: [
                {
                    name: "Series A",
                    data: [1.4, 2, 2.5, 1.5, 2.5, 2.8, 3.8, 4.6]
                },
                {
                    name: "Series B",
                    data: [20, 29, 37, 36, 44, 45, 50, 58]
                }
            ],
            stroke: {
                width: [4, 4]
            },
            plotOptions: {
                bar: {
                    columnWidth: "20%"
                }
            },
            xaxis: {
                categories: [2009, 2010, 2011, 2012, 2013, 2014, 2015, 2016]
            },
            yaxis: [
                {
                    axisTicks: {
                        show: true
                    },
                    axisBorder: {
                        show: true,
                        color: "#FF1654"
                    },
                    labels: {
                        style: {
                            colors: "#FF1654"
                        }
                    },
                    title: {
                        text: "Series A",
                        style: {
                            color: "#FF1654"
                        }
                    }
                },
                {
                    opposite: true,
                    axisTicks: {
                        show: true
                    },
                    axisBorder: {
                        show: true,
                        color: "#247BA0"
                    },
                    labels: {
                        style: {
                            colors: "#247BA0"
                        }
                    },
                    title: {
                        text: "Series B",
                        style: {
                            color: "#247BA0"
                        }
                    }
                }
            ],
            tooltip: {
                shared: false,
                intersect: true,
                x: {
                    show: false
                }
            },
            legend: {
                horizontalAlign: "left",
                offsetX: 40
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);

        chart.render();
    </script>

    <!-- pie chart  -->
    <script>
        var options = {
            chart: {
                height: 350,
                type: "pie",
                stacked: false
            },
            colors: ["#FF1654", "#247BA0"],
            series: [44, 55, 13, 33],
            labels: ['Apple', 'Mango', 'Orange', 'Watermelon']
        };

        var chart = new ApexCharts(document.querySelector("#pie_chart"), options);

        chart.render();
    </script>

    <!-- candle stick chart -->
    <script>
        var options = {
            chart: {
                height: 350,
                type: "candlestick",
                stacked: false
            },
            colors: ["#FF1654", "#247BA0"],
            series: [{
                data: [
                    [1538856000000, [6593.34, 6600, 6582.63, 6600]],
                    [1538856900000, [6595.16, 6604.76, 6590.73, 6593.86]]
                ]
            }]
        };

        var chart = new ApexCharts(document.querySelector("#candle_chart"), options);

        chart.render();
    </script>


    <!-- heatmap chart -->
    <script>
        var options = {
            chart: {
                height: 350,
                type: "heatmap",
                stacked: false
            },
            colors: ["#FF1654", "#247BA0"],
            series: [
                {
                    name: "Series 1",
                    data: [{
                        x: 'W1',
                        y: 22
                    }, {
                        x: 'W2',
                        y: 29
                    }, {
                        x: 'W3',
                        y: 13
                    }, {
                        x: 'W4',
                        y: 32
                    }]
                },
                {
                    name: "Series 2",
                    data: [{
                        x: 'W1',
                        y: 43
                    }, {
                        x: 'W2',
                        y: 43
                    }, {
                        x: 'W3',
                        y: 43
                    }, {
                        x: 'W4',
                        y: 43
                    }]
                }
            ]
        };

        var chart = new ApexCharts(document.querySelector("#heatmap_chart"), options);

        chart.render();
    </script>
</div>
>