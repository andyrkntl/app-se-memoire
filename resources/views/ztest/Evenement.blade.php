@extends('layouts.layouts')
@section('content')

    <div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Agenda</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active">Agenda</li>
        </ol>
    </div>
    <div class="col-md-7 col-4 align-self-center">
        <div class="d-flex m-t-10 justify-content-end">
            <div class="d-flex m-r-20 m-l-10 hidden-md-down">

            </div>
            <div class="d-flex m-r-20 m-l-10 hidden-md-down">


            </div>
            <div class="">
                <button class="right-side-toggle waves-effect waves-light btn-success btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
            </div>
        </div>
    </div>
</div>
                <!-- ============================================================== -->




<div class="col-md-9">
    <div class="card">
        <div class="card-body">
            <button type="button"  class="btn waves-effect waves-light btn-rounded btn-primary">Ajouter un nouvel évèment</button>
            <button type="button"  class="btn waves-effect waves-light btn-rounded btn-primary">Voir les détails</button>
            <button type="button"  class="btn waves-effect waves-light btn-rounded btn-primary">Afficher par</button>
<div id="calendar"></div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div id="calendar" class="fc fc-unthemed fc-ltr"><div class="fc-toolbar fc-header-toolbar"><div class="fc-left"><div class="fc-button-group"><button type="button" class="fc-prev-button fc-button fc-state-default fc-corner-left"><span class="fc-icon fc-icon-left-single-arrow"></span></button><button type="button" class="fc-next-button fc-button fc-state-default fc-corner-right"><span class="fc-icon fc-icon-right-single-arrow"></span></button></div><button type="button" class="fc-today-button fc-button fc-state-default fc-corner-left fc-corner-right fc-state-disabled" disabled="">today</button></div><div class="fc-right"><div class="fc-button-group"><button type="button" class="fc-month-button fc-button fc-state-default fc-corner-left fc-state-active">month</button><button type="button" class="fc-agendaWeek-button fc-button fc-state-default">week</button><button type="button" class="fc-agendaDay-button fc-button fc-state-default fc-corner-right">day</button></div></div><div class="fc-center"><h2>October 2024</h2></div><div class="fc-clear"></div></div><div class="fc-view-container" style=""><div class="fc-view fc-month-view fc-basic-view" style=""><table><thead class="fc-head"><tr><td class="fc-head-container fc-widget-header"><div class="fc-row fc-widget-header"><table><thead><tr><th class="fc-day-header fc-widget-header fc-sun"><span>Sun</span></th><th class="fc-day-header fc-widget-header fc-mon"><span>Mon</span></th><th class="fc-day-header fc-widget-header fc-tue"><span>Tue</span></th><th class="fc-day-header fc-widget-header fc-wed"><span>Wed</span></th><th class="fc-day-header fc-widget-header fc-thu"><span>Thu</span></th><th class="fc-day-header fc-widget-header fc-fri"><span>Fri</span></th><th class="fc-day-header fc-widget-header fc-sat"><span>Sat</span></th></tr></thead></table></div></td></tr></thead><tbody class="fc-body"><tr><td class="fc-widget-content"><div class="fc-scroller fc-day-grid-container" style="overflow: hidden; height: 529.5px;"><div class="fc-day-grid fc-unselectable"><div class="fc-row fc-week fc-widget-content fc-rigid" style="height: 88px;"><div class="fc-bg"><table><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-other-month fc-past" data-date="2024-09-29"></td><td class="fc-day fc-widget-content fc-mon fc-other-month fc-past" data-date="2024-09-30"></td><td class="fc-day fc-widget-content fc-tue fc-past" data-date="2024-10-01"></td><td class="fc-day fc-widget-content fc-wed fc-past" data-date="2024-10-02"></td><td class="fc-day fc-widget-content fc-thu fc-past" data-date="2024-10-03"></td><td class="fc-day fc-widget-content fc-fri fc-past" data-date="2024-10-04"></td><td class="fc-day fc-widget-content fc-sat fc-past" data-date="2024-10-05"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-other-month fc-past" data-date="2024-09-29"><span class="fc-day-number">29</span></td><td class="fc-day-top fc-mon fc-other-month fc-past" data-date="2024-09-30"><span class="fc-day-number">30</span></td><td class="fc-day-top fc-tue fc-past" data-date="2024-10-01"><span class="fc-day-number">1</span></td><td class="fc-day-top fc-wed fc-past" data-date="2024-10-02"><span class="fc-day-number">2</span></td><td class="fc-day-top fc-thu fc-past" data-date="2024-10-03"><span class="fc-day-number">3</span></td><td class="fc-day-top fc-fri fc-past" data-date="2024-10-04"><span class="fc-day-number">4</span></td><td class="fc-day-top fc-sat fc-past" data-date="2024-10-05"><span class="fc-day-number">5</span></td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table></div></div><div class="fc-row fc-week fc-widget-content fc-rigid" style="height: 88px;"><div class="fc-bg"><table><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-past" data-date="2024-10-06"></td><td class="fc-day fc-widget-content fc-mon fc-past" data-date="2024-10-07"></td><td class="fc-day fc-widget-content fc-tue fc-past" data-date="2024-10-08"></td><td class="fc-day fc-widget-content fc-wed fc-past" data-date="2024-10-09"></td><td class="fc-day fc-widget-content fc-thu fc-past" data-date="2024-10-10"></td><td class="fc-day fc-widget-content fc-fri fc-past" data-date="2024-10-11"></td><td class="fc-day fc-widget-content fc-sat fc-past" data-date="2024-10-12"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-past" data-date="2024-10-06"><span class="fc-day-number">6</span></td><td class="fc-day-top fc-mon fc-past" data-date="2024-10-07"><span class="fc-day-number">7</span></td><td class="fc-day-top fc-tue fc-past" data-date="2024-10-08"><span class="fc-day-number">8</span></td><td class="fc-day-top fc-wed fc-past" data-date="2024-10-09"><span class="fc-day-number">9</span></td><td class="fc-day-top fc-thu fc-past" data-date="2024-10-10"><span class="fc-day-number">10</span></td><td class="fc-day-top fc-fri fc-past" data-date="2024-10-11"><span class="fc-day-number">11</span></td><td class="fc-day-top fc-sat fc-past" data-date="2024-10-12"><span class="fc-day-number">12</span></td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td><td class="fc-event-container"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end bg-purple fc-draggable"><div class="fc-content"><span class="fc-time">12:50a</span> <span class="fc-title">your meeting with john</span></div></a></td></tr></tbody></table></div></div><div class="fc-row fc-week fc-widget-content fc-rigid" style="height: 88px;"><div class="fc-bg"><table><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-past" data-date="2024-10-13"></td><td class="fc-day fc-widget-content fc-mon fc-past" data-date="2024-10-14"></td><td class="fc-day fc-widget-content fc-tue fc-past" data-date="2024-10-15"></td><td class="fc-day fc-widget-content fc-wed fc-past" data-date="2024-10-16"></td><td class="fc-day fc-widget-content fc-thu fc-past" data-date="2024-10-17"></td><td class="fc-day fc-widget-content fc-fri fc-past" data-date="2024-10-18"></td><td class="fc-day fc-widget-content fc-sat fc-past" data-date="2024-10-19"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-past" data-date="2024-10-13"><span class="fc-day-number">13</span></td><td class="fc-day-top fc-mon fc-past" data-date="2024-10-14"><span class="fc-day-number">14</span></td><td class="fc-day-top fc-tue fc-past" data-date="2024-10-15"><span class="fc-day-number">15</span></td><td class="fc-day-top fc-wed fc-past" data-date="2024-10-16"><span class="fc-day-number">16</span></td><td class="fc-day-top fc-thu fc-past" data-date="2024-10-17"><span class="fc-day-number">17</span></td><td class="fc-day-top fc-fri fc-past" data-date="2024-10-18"><span class="fc-day-number">18</span></td><td class="fc-day-top fc-sat fc-past" data-date="2024-10-19"><span class="fc-day-number">19</span></td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table></div></div><div class="fc-row fc-week fc-widget-content fc-rigid" style="height: 88px;"><div class="fc-bg"><table><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-past" data-date="2024-10-20"></td><td class="fc-day fc-widget-content fc-mon fc-past" data-date="2024-10-21"></td><td class="fc-day fc-widget-content fc-tue fc-past" data-date="2024-10-22"></td><td class="fc-day fc-widget-content fc-wed fc-past" data-date="2024-10-23"></td><td class="fc-day fc-widget-content fc-thu fc-past" data-date="2024-10-24"></td><td class="fc-day fc-widget-content fc-fri fc-today fc-state-highlight" data-date="2024-10-25"></td><td class="fc-day fc-widget-content fc-sat fc-future" data-date="2024-10-26"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-past" data-date="2024-10-20"><span class="fc-day-number">20</span></td><td class="fc-day-top fc-mon fc-past" data-date="2024-10-21"><span class="fc-day-number">21</span></td><td class="fc-day-top fc-tue fc-past" data-date="2024-10-22"><span class="fc-day-number">22</span></td><td class="fc-day-top fc-wed fc-past" data-date="2024-10-23"><span class="fc-day-number">23</span></td><td class="fc-day-top fc-thu fc-past" data-date="2024-10-24"><span class="fc-day-number">24</span></td><td class="fc-day-top fc-fri fc-today fc-state-highlight" data-date="2024-10-25"><span class="fc-day-number">25</span></td><td class="fc-day-top fc-sat fc-future" data-date="2024-10-26"><span class="fc-day-number">26</span></td></tr></thead><tbody><tr><td></td><td class="fc-event-container" colspan="3"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end bg-info fc-draggable"><div class="fc-content"><span class="fc-time">7:04a</span> <span class="fc-title">your meeting with john</span></div></a></td><td></td><td class="fc-event-container"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end bg-danger fc-draggable"><div class="fc-content"><span class="fc-time">9:54p</span> <span class="fc-title">This is today check date</span></div></a></td><td></td></tr></tbody></table></div></div><div class="fc-row fc-week fc-widget-content fc-rigid" style="height: 88px;"><div class="fc-bg"><table><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-future" data-date="2024-10-27"></td><td class="fc-day fc-widget-content fc-mon fc-future" data-date="2024-10-28"></td><td class="fc-day fc-widget-content fc-tue fc-future" data-date="2024-10-29"></td><td class="fc-day fc-widget-content fc-wed fc-future" data-date="2024-10-30"></td><td class="fc-day fc-widget-content fc-thu fc-future" data-date="2024-10-31"></td><td class="fc-day fc-widget-content fc-fri fc-other-month fc-future" data-date="2024-11-01"></td><td class="fc-day fc-widget-content fc-sat fc-other-month fc-future" data-date="2024-11-02"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-future" data-date="2024-10-27"><span class="fc-day-number">27</span></td><td class="fc-day-top fc-mon fc-future" data-date="2024-10-28"><span class="fc-day-number">28</span></td><td class="fc-day-top fc-tue fc-future" data-date="2024-10-29"><span class="fc-day-number">29</span></td><td class="fc-day-top fc-wed fc-future" data-date="2024-10-30"><span class="fc-day-number">30</span></td><td class="fc-day-top fc-thu fc-future" data-date="2024-10-31"><span class="fc-day-number">31</span></td><td class="fc-day-top fc-fri fc-other-month fc-future" data-date="2024-11-01"><span class="fc-day-number">1</span></td><td class="fc-day-top fc-sat fc-other-month fc-future" data-date="2024-11-02"><span class="fc-day-number">2</span></td></tr></thead><tbody><tr><td></td><td></td><td class="fc-event-container"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end bg-success fc-draggable"><div class="fc-content"><span class="fc-time">10:34p</span> <span class="fc-title">Like it?</span></div></a></td><td></td><td class="fc-event-container"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end bg-info fc-draggable"><div class="fc-content"><span class="fc-time">6:40p</span> <span class="fc-title">Released Ample Admin!</span></div></a></td><td></td><td></td></tr></tbody></table></div></div><div class="fc-row fc-week fc-widget-content fc-rigid" style="height: 89px;"><div class="fc-bg"><table><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-other-month fc-future" data-date="2024-11-03"></td><td class="fc-day fc-widget-content fc-mon fc-other-month fc-future" data-date="2024-11-04"></td><td class="fc-day fc-widget-content fc-tue fc-other-month fc-future" data-date="2024-11-05"></td><td class="fc-day fc-widget-content fc-wed fc-other-month fc-future" data-date="2024-11-06"></td><td class="fc-day fc-widget-content fc-thu fc-other-month fc-future" data-date="2024-11-07"></td><td class="fc-day fc-widget-content fc-fri fc-other-month fc-future" data-date="2024-11-08"></td><td class="fc-day fc-widget-content fc-sat fc-other-month fc-future" data-date="2024-11-09"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-other-month fc-future" data-date="2024-11-03"><span class="fc-day-number">3</span></td><td class="fc-day-top fc-mon fc-other-month fc-future" data-date="2024-11-04"><span class="fc-day-number">4</span></td><td class="fc-day-top fc-tue fc-other-month fc-future" data-date="2024-11-05"><span class="fc-day-number">5</span></td><td class="fc-day-top fc-wed fc-other-month fc-future" data-date="2024-11-06"><span class="fc-day-number">6</span></td><td class="fc-day-top fc-thu fc-other-month fc-future" data-date="2024-11-07"><span class="fc-day-number">7</span></td><td class="fc-day-top fc-fri fc-other-month fc-future" data-date="2024-11-08"><span class="fc-day-number">8</span></td><td class="fc-day-top fc-sat fc-other-month fc-future" data-date="2024-11-09"><span class="fc-day-number">9</span></td></tr></thead><tbody><tr><td rowspan="2"></td><td class="fc-event-container fc-limited"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end bg-info fc-draggable"><div class="fc-content"><span class="fc-time">5:27p</span> <span class="fc-title">This is your birthday</span></div></a></td><td class="fc-more-cell" rowspan="1"><div><a class="fc-more">+2 more</a></div></td><td rowspan="2"></td><td rowspan="2"></td><td rowspan="2"></td><td rowspan="2"></td><td rowspan="2"></td></tr><tr class="fc-limited"><td class="fc-event-container"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end bg-danger fc-draggable"><div class="fc-content"><span class="fc-time">11p</span> <span class="fc-title">Hanns birthday</span></div></a></td></tr></tbody></table></div></div></div></div></td></tr></tbody></table></div></div></div>
        <!-- BEGIN MODAL -->
        <div class="modal fade none-border" id="my-event">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><strong>ajouter un evenement</strong></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white waves-effect" data-dismiss="modal">Fermer</button>
                        <button type="button" class="btn btn-success save-event waves-effect waves-light">Create event</button>
                        <button type="button" class="btn btn-danger delete-event waves-effect waves-light" data-dismiss="modal">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Add Category -->
        <div class="modal fade none-border" id="add-new-event">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><strong>Add</strong> a category</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="control-label">Category Name</label>
                                    <input class="form-control form-white" placeholder="Enter name" type="text" name="category-name">
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label">Choose Category Color</label>
                                    <select class="form-control form-white" data-placeholder="Choose a color..." name="category-color">
                                        <option value="success">Success</option>
                                        <option value="danger">Danger</option>
                                        <option value="info">Info</option>
                                        <option value="primary">Primary</option>
                                        <option value="warning">Warning</option>
                                        <option value="inverse">Inverse</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger waves-effect waves-light save-category" data-dismiss="modal">Save</button>
                        <button type="button" class="btn btn-white waves-effect" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MODAL -->
    </div>
</div>
@endsection
