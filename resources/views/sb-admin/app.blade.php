<!DOCTYPE html>
<html lang="en">

@include('sb-admin/head')

<body id="page-top" class="@yield('bg-blue')">

    @yield('navbar-home')

    @hasSection('content')
        <div id="wrapper">

            <!-- Sidebar -->
            @include('sb-admin/sidebar')
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    @include('sb-admin/topbar')
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        @yield('content')

                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                @include('sb-admin/footer')
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
    @endif

    @hasSection('body')
        @yield('body')
    @endif

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    @include('sb-admin/logout')

    <!-- Bootstrap core JavaScript-->
    @include('sb-admin/script')

    @yield('script')

    @include('sweetalert::alert')

</body>

</html>
