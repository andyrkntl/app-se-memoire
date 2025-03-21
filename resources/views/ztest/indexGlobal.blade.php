@extends('layouts.layouts')
@section('content')


<div class="col-lg-8">
    <div class="card">
        <div class="card-body">
            <div class="d-flex no-block">
                <h4 class="card-title">Liste dex chantiers</h4>
                <div class="ml-auto">
                    <select class="custom-select">
                        <option selected="">January</option>
                        <option value="1">February</option>
                        <option value="2">March</option>
                        <option value="3">April</option>
                    </select>
                </div>
            </div>
            <div class="table-responsive m-t-20">
                <table class="table stylish-table">
                    <thead>
                        <tr>
                            <th colspan="2">Assigned</th>
                            <th>Name</th>
                            <th>Priority</th>
                            <th>Budget</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="width:50px;"><span class="round">S</span></td>
                            <td>
                                <h6>Sunil Joshi</h6><small class="text-muted">Web Designer</small></td>
                            <td>Elite Admin</td>
                            <td><span class="label label-success">Low</span></td>
                            <td>$3.9K</td>
                        </tr>
                        <tr class="active">
                            <td><span class="round"><img src="../assets/images/users/2.jpg" alt="user" width="50"></span></td>
                            <td>
                                <h6>Andrew</h6><small class="text-muted">Project Manager</small></td>
                            <td>Real Homes</td>
                            <td><span class="label label-info">Medium</span></td>
                            <td>$23.9K</td>
                        </tr>
                        <tr>
                            <td><span class="round round-success">B</span></td>
                            <td>
                                <h6>Bhavesh patel</h6><small class="text-muted">Developer</small></td>
                            <td>MedicalPro Theme</td>
                            <td><span class="label label-primary">High</span></td>
                            <td>$12.9K</td>
                        </tr>
                        <tr>
                            <td><span class="round round-primary">N</span></td>
                            <td>
                                <h6>Nirav Joshi</h6><small class="text-muted">Frontend Eng</small></td>
                            <td>Elite Admin</td>
                            <td><span class="label label-danger">Low</span></td>
                            <td>$10.9K</td>
                        </tr>
                        <tr>
                            <td><span class="round round-warning">M</span></td>
                            <td>
                                <h6>Micheal Doe</h6><small class="text-muted">Content Writer</small></td>
                            <td>Helping Hands</td>
                            <td><span class="label label-warning">High</span></td>
                            <td>$12.9K</td>
                        </tr>
                        <tr>
                            <td><span class="round round-danger">N</span></td>
                            <td>
                                <h6>Johnathan</h6><small class="text-muted">Graphic</small></td>
                            <td>Digital Agency</td>
                            <td><span class="label label-info">High</span></td>
                            <td>$2.6K</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection
