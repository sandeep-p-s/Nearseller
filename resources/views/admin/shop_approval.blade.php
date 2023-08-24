@extends('backendlayout')
@section('content')
    @include('menu')
    @include('topnav')


    <!-- Page Content-->
    <div class="page-content">
        <div class="container-fluid">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="row">
                            <div class="col">
                                <h4 class="page-title">Shop Approval List</h4>

                            </div><!--end col-->

                        </div><!--end row-->
                    </div><!--end page-title-box-->
                </div><!--end col-->
            </div><!--end row-->
            <!-- end page title end breadcrumb -->
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Shop/Service Name</th>
                                        <th>Shop/Service Id</th>
                                        <th>Transaction Id</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Dragon tattoo studio</td>
                                        <td>34546565</td>
                                        <td>678787</td>
                                        <td>
                                            <div class="btn-group mb-2 mb-md-0">
                                                <button type="button" class="btn view_btn dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action
                                                    <i class="mdi mdi-chevron-down"></i></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item view_btn1"
                                                        href="shop_approval_view.html">View</a>
                                                    <a class="dropdown-item approve_btn" href="#">Approve</a>
                                                    <a class="dropdown-item delete_btn" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Taj Spares</td>
                                        <td>46565765</td>
                                        <td>6346546</td>
                                        <td>
                                            <div class="btn-group mb-2 mb-md-0">
                                                <button type="button" class="btn view_btn dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action
                                                    <i class="mdi mdi-chevron-down"></i></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item view_btn1"
                                                        href="shop_approval_view.html">View</a>
                                                    <a class="dropdown-item approve_btn" href="#">Approve</a>
                                                    <a class="dropdown-item delete_btn" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>

                                        <td>3</td>
                                        <td>Technical company</td>
                                        <td>23424343</td>
                                        <td>664544</td>
                                        <td>
                                            <div class="btn-group mb-2 mb-md-0">
                                                <button type="button" class="btn view_btn dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action
                                                    <i class="mdi mdi-chevron-down"></i></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item view_btn1"
                                                        href="shop_approval_view.html">View</a>
                                                    <a class="dropdown-item approve_btn" href="#">Approve</a>
                                                    <a class="dropdown-item delete_btn" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>New Saloon</td>
                                        <td>34546565</td>
                                        <td>224646</td>
                                        <td>
                                            <div class="btn-group mb-2 mb-md-0">
                                                <button type="button" class="btn view_btn dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action
                                                    <i class="mdi mdi-chevron-down"></i></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item view_btn1"
                                                        href="shop_approval_view.html">View</a>
                                                    <a class="dropdown-item approve_btn" href="#">Approve</a>
                                                    <a class="dropdown-item delete_btn" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Dev Mechanics</td>
                                        <td>46565765</td>
                                        <td>3346464</td>
                                        <td>
                                            <div class="btn-group mb-2 mb-md-0">
                                                <button type="button" class="btn view_btn dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action
                                                    <i class="mdi mdi-chevron-down"></i></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item view_btn1"
                                                        href="shop_approval_view.html">View</a>
                                                    <a class="dropdown-item approve_btn" href="#">Approve</a>
                                                    <a class="dropdown-item delete_btn" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>Prema beauty parlour</td>
                                        <td>1121324</td>
                                        <td>678787</td>
                                        <td>
                                            <div class="btn-group mb-2 mb-md-0">
                                                <button type="button" class="btn view_btn dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action
                                                    <i class="mdi mdi-chevron-down"></i></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item view_btn1"
                                                        href="shop_approval_view.html">View</a>
                                                    <a class="dropdown-item approve_btn" href="#">Approve</a>
                                                    <a class="dropdown-item delete_btn" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>Deva hair saloon</td>
                                        <td>23424343</td>
                                        <td>5976767</td>
                                        <td>
                                            <div class="btn-group mb-2 mb-md-0">
                                                <button type="button" class="btn view_btn dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">Action <i
                                                        class="mdi mdi-chevron-down"></i></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item view_btn1"
                                                        href="shop_approval_view.html">View</a>
                                                    <a class="dropdown-item approve_btn" href="#">Approve</a>
                                                    <a class="dropdown-item delete_btn" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>Mens wear</td>
                                        <td>46565765</td>
                                        <td>55767677</td>
                                        <td>
                                            <div class="btn-group mb-2 mb-md-0">
                                                <button type="button" class="btn view_btn dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">Action <i
                                                        class="mdi mdi-chevron-down"></i></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item view_btn1"
                                                        href="shop_approval_view.html">View</a>
                                                    <a class="dropdown-item approve_btn" href="#">Approve</a>
                                                    <a class="dropdown-item delete_btn" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>9</td>
                                        <td>Diyan styles</td>
                                        <td>23424343</td>
                                        <td>3967677</td>
                                        <td>
                                            <div class="btn-group mb-2 mb-md-0">
                                                <button type="button" class="btn view_btn dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">Action <i
                                                        class="mdi mdi-chevron-down"></i></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item view_btn1"
                                                        href="shop_approval_view.html">View</a>
                                                    <a class="dropdown-item approve_btn" href="#">Approve</a>
                                                    <a class="dropdown-item delete_btn" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>10</td>
                                        <td>Hi mobiles</td>
                                        <td>5656578</td>
                                        <td>2367676</td>
                                        <td>
                                            <div class="btn-group mb-2 mb-md-0">
                                                <button type="button" class="btn view_btn dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">Action <i
                                                        class="mdi mdi-chevron-down"></i></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item view_btn1"
                                                        href="shop_approval_view.html">View</a>
                                                    <a class="dropdown-item approve_btn" href="#">Approve</a>
                                                    <a class="dropdown-item delete_btn" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>11</td>
                                        <td>Dev Mechanics</td>
                                        <td>5767676</td>
                                        <td>305657</td>
                                        <td>
                                            <div class="btn-group mb-2 mb-md-0">
                                                <button type="button" class="btn view_btn dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">Action <i
                                                        class="mdi mdi-chevron-down"></i></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item view_btn1"
                                                        href="shop_approval_view.html">View</a>
                                                    <a class="dropdown-item approve_btn" href="#">Approve</a>
                                                    <a class="dropdown-item delete_btn" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>12</td>
                                        <td>Support Lead</td>
                                        <td>465656</td>
                                        <td>2257657</td>
                                        <td>
                                            <div class="btn-group mb-2 mb-md-0">
                                                <button type="button" class="btn view_btn dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">Action <i
                                                        class="mdi mdi-chevron-down"></i></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item view_btn1"
                                                        href="shop_approval_view.html">View</a>
                                                    <a class="dropdown-item approve_btn" href="#">Approve</a>
                                                    <a class="dropdown-item delete_btn" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>13</td>
                                        <td>New Saloon</td>
                                        <td>23424343</td>
                                        <td>36575775</td>
                                        <td>
                                            <div class="btn-group mb-2 mb-md-0">
                                                <button type="button" class="btn view_btn dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">Action <i
                                                        class="mdi mdi-chevron-down"></i></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item view_btn1"
                                                        href="shop_approval_view.html">View</a>
                                                    <a class="dropdown-item approve_btn" href="#">Approve</a>
                                                    <a class="dropdown-item delete_btn" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>14</td>
                                        <td>Hi mobiles</td>
                                        <td>5767676</td>
                                        <td>4356577</td>
                                        <td>
                                            <div class="btn-group mb-2 mb-md-0">
                                                <button type="button" class="btn view_btn dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">Action <i
                                                        class="mdi mdi-chevron-down"></i></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item view_btn1"
                                                        href="shop_approval_view.html">View</a>
                                                    <a class="dropdown-item approve_btn" href="#">Approve</a>
                                                    <a class="dropdown-item delete_btn" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>15</td>
                                        <td>Regional Director</td>
                                        <td>5767676</td>
                                        <td>1957657</td>
                                        <td>
                                            <div class="btn-group mb-2 mb-md-0">
                                                <button type="button" class="btn view_btn dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">Action <i
                                                        class="mdi mdi-chevron-down"></i></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item view_btn1"
                                                        href="shop_approval_view.html">View</a>
                                                    <a class="dropdown-item approve_btn" href="#">Approve</a>
                                                    <a class="dropdown-item delete_btn" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>16</td>
                                        <td>Marketing Designer</td>
                                        <td>5767676</td>
                                        <td>665777</td>
                                        <td>
                                            <div class="btn-group mb-2 mb-md-0">
                                                <button type="button" class="btn view_btn dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">Action <i
                                                        class="mdi mdi-chevron-down"></i></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item view_btn1"
                                                        href="shop_approval_view.html">View</a>
                                                    <a class="dropdown-item approve_btn" href="#">Approve</a>
                                                    <a class="dropdown-item delete_btn" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>17</td>
                                        <td>Hi mobiles</td>
                                        <td>1121324</td>
                                        <td>6457757</td>
                                        <td>
                                            <div class="btn-group mb-2 mb-md-0">
                                                <button type="button" class="btn view_btn dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">Action <i
                                                        class="mdi mdi-chevron-down"></i></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item view_btn1"
                                                        href="shop_approval_view.html">View</a>
                                                    <a class="dropdown-item approve_btn" href="#">Approve</a>
                                                    <a class="dropdown-item delete_btn" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>18</td>
                                        <td>Systems Administrator</td>
                                        <td>1121324</td>
                                        <td>5957577</td>
                                        <td>
                                            <div class="btn-group mb-2 mb-md-0">
                                                <button type="button" class="btn view_btn dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">Action <i
                                                        class="mdi mdi-chevron-down"></i></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item view_btn1"
                                                        href="shop_approval_view.html">View</a>
                                                    <a class="dropdown-item approve_btn" href="#">Approve</a>
                                                    <a class="dropdown-item delete_btn" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>19</td>
                                        <td>Dev Mechanics</td>
                                        <td>5767676</td>
                                        <td>4157577</td>
                                        <td>
                                            <div class="btn-group mb-2 mb-md-0">
                                                <button type="button" class="btn view_btn dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">Action <i
                                                        class="mdi mdi-chevron-down"></i></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item view_btn1"
                                                        href="shop_approval_view.html">View</a>
                                                    <a class="dropdown-item approve_btn" href="#">Approve</a>
                                                    <a class="dropdown-item delete_btn" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>20</td>
                                        <td>New Saloon</td>
                                        <td>34546565</td>
                                        <td>3557574</td>
                                        <td>
                                            <div class="btn-group mb-2 mb-md-0">
                                                <button type="button" class="btn view_btn dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">Action <i
                                                        class="mdi mdi-chevron-down"></i></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item view_btn1"
                                                        href="shop_approval_view.html">View</a>
                                                    <a class="dropdown-item approve_btn" href="#">Approve</a>
                                                    <a class="dropdown-item delete_btn" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>21</td>
                                        <td>Development Lead</td>
                                        <td>1121324</td>
                                        <td>30465477</td>
                                        <td>
                                            <div class="btn-group mb-2 mb-md-0">
                                                <button type="button" class="btn view_btn dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">Action <i
                                                        class="mdi mdi-chevron-down"></i></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item view_btn1"
                                                        href="shop_approval_view.html">View</a>
                                                    <a class="dropdown-item approve_btn" href="#">Approve</a>
                                                    <a class="dropdown-item delete_btn" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>22</td>
                                        <td>Chief Marketing Officer (CMO)</td>
                                        <td>1121324</td>
                                        <td>4047755</td>
                                        <td>
                                            <div class="btn-group mb-2 mb-md-0">
                                                <button type="button" class="btn view_btn dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">Action <i
                                                        class="mdi mdi-chevron-down"></i></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item view_btn1"
                                                        href="shop_approval_view.html">View</a>
                                                    <a class="dropdown-item approve_btn" href="#">Approve</a>
                                                    <a class="dropdown-item delete_btn" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>23</td>
                                        <td>Pre-Sales Support</td>
                                        <td>1121324</td>
                                        <td>21545757</td>
                                        <td>
                                            <div class="btn-group mb-2 mb-md-0">
                                                <button type="button" class="btn view_btn dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">Action <i
                                                        class="mdi mdi-chevron-down"></i></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item view_btn1"
                                                        href="shop_approval_view.html">View</a>
                                                    <a class="dropdown-item approve_btn" href="#">Approve</a>
                                                    <a class="dropdown-item delete_btn" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>24</td>
                                        <td>Sales Assistant</td>
                                        <td>878787</td>
                                        <td>2357575</td>
                                        <td>
                                            <div class="btn-group mb-2 mb-md-0">
                                                <button type="button" class="btn view_btn dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">Action <i
                                                        class="mdi mdi-chevron-down"></i></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item view_btn1"
                                                        href="shop_approval_view.html">View</a>
                                                    <a class="dropdown-item approve_btn" href="#">Approve</a>
                                                    <a class="dropdown-item delete_btn" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>25</td>
                                        <td>Chief Executive Officer (CEO)</td>
                                        <td>5767676</td>
                                        <td>4757577</td>
                                        <td>
                                            <div class="btn-group mb-2 mb-md-0">
                                                <button type="button" class="btn view_btn dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">Action <i
                                                        class="mdi mdi-chevron-down"></i></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item view_btn1"
                                                        href="shop_approval_view.html">View</a>
                                                    <a class="dropdown-item approve_btn" href="#">Approve</a>
                                                    <a class="dropdown-item delete_btn" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>26</td>
                                        <td>New Saloon</td>
                                        <td>34546565</td>
                                        <td>4257555</td>
                                        <td>
                                            <div class="btn-group mb-2 mb-md-0">
                                                <button type="button" class="btn view_btn dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">Action <i
                                                        class="mdi mdi-chevron-down"></i></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item view_btn1"
                                                        href="shop_approval_view.html">View</a>
                                                    <a class="dropdown-item approve_btn" href="#">Approve</a>
                                                    <a class="dropdown-item delete_btn" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>27</td>
                                        <td>Regional Director</td>
                                        <td>8656564</td>
                                        <td>28567575</td>
                                        <td>
                                            <div class="btn-group mb-2 mb-md-0">
                                                <button type="button" class="btn view_btn dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">Action <i
                                                        class="mdi mdi-chevron-down"></i></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item view_btn1"
                                                        href="shop_approval_view.html">View</a>
                                                    <a class="dropdown-item approve_btn" href="#">Approve</a>
                                                    <a class="dropdown-item delete_btn" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>28</td>
                                        <td>Dev Mechanics</td>
                                        <td>23424343</td>
                                        <td>2857577</td>
                                        <td>
                                            <div class="btn-group mb-2 mb-md-0">
                                                <button type="button" class="btn view_btn dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">Action <i
                                                        class="mdi mdi-chevron-down"></i></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item view_btn1"
                                                        href="shop_approval_view.html">View</a>
                                                    <a class="dropdown-item approve_btn" href="#">Approve</a>
                                                    <a class="dropdown-item delete_btn" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>29</td>
                                        <td>Chief Operating Officer (COO)</td>
                                        <td>23424343</td>
                                        <td>4855757</td>
                                        <td>
                                            <div class="btn-group mb-2 mb-md-0">
                                                <button type="button" class="btn view_btn dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">Action <i
                                                        class="mdi mdi-chevron-down"></i></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item view_btn1"
                                                        href="shop_approval_view.html">View</a>
                                                    <a class="dropdown-item approve_btn" href="#">Approve</a>
                                                    <a class="dropdown-item delete_btn" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>30</td>
                                        <td>New Saloon</td>
                                        <td>4546546</td>
                                        <td>2057577</td>
                                        <td>
                                            <div class="btn-group mb-2 mb-md-0">
                                                <button type="button" class="btn view_btn dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">Action <i
                                                        class="mdi mdi-chevron-down"></i></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item view_btn1"
                                                        href="shop_approval_view.html">View</a>
                                                    <a class="dropdown-item approve_btn" href="#">Approve</a>
                                                    <a class="dropdown-item delete_btn" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div><!-- container -->
    @endsection
