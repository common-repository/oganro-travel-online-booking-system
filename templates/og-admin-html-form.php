<div class="og-travel-admin-wrap">
    <div class="container ">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3>Oganro Travel Widget
                            <small class="pull-right">Short Code [og_travel_widget]</small>
                        </h3>

                    </div>
                </div>
            </div>
        </div>

        <?php if ($message != ''): ?>

            <div class="row">
                <div class="col-sm-12">
                    <p class="bg-success success-message"> <?= $message ?> </p>
                </div>
            </div>

        <?php endif; ?>

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST"
                              action="<?= admin_url('admin.php?page=og_travel_admin_page', ''); ?>">
                            <input type="hidden" name="form-data" value="1">
                            <ul class="nav nav-pills">
                                <li class="active">
                                    <a href="#general" data-toggle="tab">General</a>
                                </li>
                                <li>
                                    <a href="#hotel-widget" data-toggle="tab">Hotel Widget</a>
                                </li>
                                <li>
                                    <a href="#transfer-widget" data-toggle="tab">Transfer Widget</a>
                                </li>
                                <li>
                                    <a href="#activities-widget" data-toggle="tab">Activities Widget</a>
                                </li>
                                <li>
                                    <a href="#car-rent-widget" data-toggle="tab">Car Rental Widget</a>
                                </li>
                                <li>
                                    <a href="#flights-widget" data-toggle="tab">Flights Widget</a>
                                </li>
                            </ul>

                            <div class="tab-content clearfix">
                                <div class="tab-pane active" id="general">
                                    <hr>
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="ota_url" class="col-sm-2 control-label">Travel Agent Url</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="ota_url"
                                                       name="general[ota_url]"
                                                       placeholder="Travel Agent Url" value=""
                                                >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group">
                                            <label for="status" class="col-sm-2 control-label">Status</label>
                                            <div class="col-sm-6">
                                                <label class="radio-inline">
                                                    <input type="radio" name="general[status]" id="status-a" value="1"
                                                        <?= ($data['general']['status'] == '1') ? 'checked' : '' ?>>
                                                    Active
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="general[status]" id="status-b" value="0"
                                                        <?= ($data['general']['status'] == '0') ? 'checked' : '' ?>>
                                                    Inactive
                                                </label>
                                            </div>
                                        </div>
                                    </div>


                                    <h4>Widget Theme</h4>
                                    <hr>

                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label for="bg-color" class="col-sm-6 control-label">Widget Background
                                                Color</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control color" id="bg-color"
                                                       name="general[wid_bg_color]">
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label for="wid-font-color" class="col-sm-6 control-label">Widget Font
                                                Color</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control color-hex" id="wid-font-color"
                                                       name="general[wid_font_color]">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label for="btn-bg-color" class="col-sm-6 control-label">Button Background
                                                Color</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control color" id="btn-bg-color"
                                                       name="general[btn_bg_color]">
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="btn-font-color" class="col-sm-6 control-label">Button Font
                                                Color</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control color-hex" id="btn-font-color"
                                                       name="general[btn_font_color]">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label for="widget-width" class="col-sm-6 control-label">Widget
                                                Width</label>
                                            <div class="col-sm-5">
                                                <input type="number" class="form-control" id="widget-width"
                                                       name="general[widget_width]" min="0"
                                                       max="100" placeholder="100">
                                            </div>
                                            <span class="text-muted">%</span>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="widget-align" class="col-sm-6 control-label">Widget
                                                Alignment</label>
                                            <div class="col-sm-6">
                                                <select name="general[widget_align]" id="widget-align"
                                                        class="form-control">
                                                    <option value="left">Left</option>
                                                    <option value="center">Center</option>
                                                    <option value="right">Right</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label for="widget-border" class="col-sm-6 control-label">Widget Border
                                                Size</label>
                                            <div class="col-sm-5">
                                                <input type="number" class="form-control" id="widget-border"
                                                       name="general[widget_border]" min="0"
                                                       placeholder="0">
                                            </div>
                                            <span class="text-muted">px</span>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="widget-border-color" class="col-sm-6 control-label">Widget
                                                Border
                                                Color</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control color-hex"
                                                       id="widget-border-color"
                                                       name="general[widget_border_color]">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label for="widget-border-radius" class="col-sm-6 control-label">Widget
                                                Border
                                                Radius</label>
                                            <div class="col-sm-5">
                                                <input type="number" class="form-control" id="widget-border-radius"
                                                       name="general[widget_border_radius]" min="0"
                                                       placeholder="0">
                                            </div>
                                            <span class="text-muted">px</span>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="widget_btn_border_radius" class="col-sm-6 control-label">Widget
                                                Button Border
                                                Radius</label>
                                            <div class="col-sm-5">
                                                <input type="number" class="form-control" id="widget_btn_border_radius"
                                                       name="general[widget_btn_border_radius]" min="0"
                                                       placeholder="0">
                                            </div>
                                            <span class="text-muted">px</span>
                                        </div>
                                    </div>

                                    <h4>Inputs Settings</h4>
                                    <hr>

                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label for="widget_inpt_border_radius" class="col-sm-6 control-label">Widget
                                                Input Border
                                                Radius</label>
                                            <div class="col-sm-5">
                                                <input type="number" class="form-control" id="widget_inpt_border_radius"
                                                       name="general[widget_inpt_border_radius]" min="0"
                                                       placeholder="0">
                                            </div>
                                            <span class="text-muted">px</span>
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label for="widget_inpt_bg_color" class="col-sm-6 control-label">Inputs
                                                Background
                                                Color</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control color" id="widget_inpt_bg_color"
                                                       name="general[widget_inpt_bg_color]">
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label for="widget_inpt_fnt_color" class="col-sm-6 control-label">Inputs
                                                Font
                                                Color</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control color-hex"
                                                       id="widget_inpt_fnt_color"
                                                       name="general[widget_inpt_fnt_color]">
                                            </div>
                                        </div>
                                    </div>

                                    <h4>Calendar Settings</h4>
                                    <hr>
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label for="widget_clndr_bg_color" class="col-sm-6 control-label">Calendar
                                                Background
                                                Color</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control color" id="widget_clndr_bg_color"
                                                       name="general[widget_clndr_bg_color]">
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label for="widget_clndr_fnt_color" class="col-sm-6 control-label">Calendar
                                                Font
                                                Color</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control color-hex"
                                                       id="widget_clndr_fnt_color"
                                                       name="general[widget_clndr_fnt_color]">
                                            </div>
                                        </div>
                                    </div>

                                    <h4>Custom Settings</h4>
                                    <hr>
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label for="custom_styles" class="col-sm-3 control-label">Custom CSS</label>
                                            <div class="col-sm-9">
                                                <textarea name="general[custom_styles]" id="custom_styles"
                                                          cols="30" rows="10" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="hotel-widget">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="status" class="col-sm-2 control-label">Show
                                                    Hotels</label>
                                                <div class="col-sm-6">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="hotel[status]" id="status-a"
                                                               value="1" <?= ($data['hotel']['status'] == '1') ? 'checked' : '' ?>>
                                                        Yes
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="hotel[status]" id="status-b"
                                                               value="0" <?= ($data['hotel']['status'] == '0') ? 'checked' : '' ?>>
                                                        No
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <h4>Location Settings</h4>
                                            <hr>
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label for="ht-location-title" class="col-sm-6 control-label">Location
                                                Title</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="ht-location-title"
                                                       name="hotel[ht_location_title]">
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label for="ht-location-pholder" class="col-sm-6 control-label">Location
                                                Placeholder</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="ht-location-pholder"
                                                       name="hotel[ht_location_pholder]">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h4>Datepicker Settings</h4>
                                            <hr>
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label for="ht-checkin-title" class="col-sm-6 control-label">Check-in
                                                Title</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="ht-checkin-title"
                                                       name="hotel[ht_checkin_title]">
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label for="ht-checkout-title" class="col-sm-6 control-label">Check-out
                                                Title</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="ht-checkout-title"
                                                       name="hotel[ht_checkout_title]">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h4>Nights Settings</h4>
                                            <hr>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="ht-nights-title" class="col-sm-6 control-label">Nights
                                                Title</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="ht-nights-title"
                                                       name="hotel[ht_nights_title]">
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label for="ht-nights-count" class="col-sm-6 control-label">Default
                                                Nights</label>
                                            <div class="col-sm-6">
                                                <select name="hotel[ht_nights_count]" id="ht-nights-count"
                                                        class="form-control">
                                                    <?php for ($i = 1; $i <= 30; $i++): ?>
                                                        <option value="<?= $i ?>"><?= $i ?></option>
                                                    <?php endfor; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="tab-pane" id="transfer-widget">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="status" class="col-sm-2 control-label">Show
                                                    Transfers</label>
                                                <div class="col-sm-6">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="transfer[status]" id="status-a"
                                                               value="1" <?= ($data['transfer']['status'] == '1') ? 'checked' : '' ?>>
                                                        Yes
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="transfer[status]" id="status-b"
                                                               value="0" <?= ($data['transfer']['status'] == '0') ? 'checked' : '' ?>>
                                                        No
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <h4>Pick-up Settings</h4>
                                            <hr>
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label for="tr-pickup_loc_title" class="col-sm-6 control-label">
                                                Pick-up Location Title
                                            </label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="tr-pickup_loc_title"
                                                       name="transfer[pickup_loc_title]">
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label for="tr-pickup_loc_pholder" class="col-sm-6 control-label">
                                                Pick-up Location Placeholder
                                            </label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="tr-pickup_loc_pholder"
                                                       name="transfer[pickup_loc_pholder]">
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label for="tr-pickup_dat_title" class="col-sm-6 control-label">
                                                Pick-up Date Title
                                            </label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="tr-pickup_dat_title"
                                                       name="transfer[pickup_dat_title]">
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label for="tr-pickup_time_title" class="col-sm-6 control-label">
                                                Pick-up Time Title
                                            </label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="tr-pickup_time_title"
                                                       name="transfer[pickup_time_title]">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h4>Drop-off Settings</h4>
                                            <hr>
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label for="tr-drop_loc_title" class="col-sm-6 control-label">
                                                Drop-off Location Title
                                            </label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="tr-drop_loc_title"
                                                       name="transfer[drop_loc_title]">
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label for="tr-drop_loc_pholder" class="col-sm-6 control-label">
                                                Drop-off Location Placeholder
                                            </label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="tr-drop_loc_pholder"
                                                       name="transfer[drop_loc_pholder]">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h4>Return Settings</h4>
                                            <hr>
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label for="tr-return_dat_title" class="col-sm-6 control-label">
                                                Return Date Title
                                            </label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="tr-return_dat_title"
                                                       name="transfer[return_dat_title]">
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label for="tr-return_time_title" class="col-sm-6 control-label">
                                                Return Time Title
                                            </label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="tr-return_time_title"
                                                       name="transfer[return_time_title]">
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="tab-pane" id="activities-widget">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="status" class="col-sm-2 control-label">Show
                                                    Activities</label>
                                                <div class="col-sm-6">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="activities[status]" id="status-a"
                                                               value="1" <?= ($data['activities']['status'] == '1') ? 'checked' : '' ?>>
                                                        Yes
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="activities[status]" id="status-b"
                                                               value="0" <?= ($data['activities']['status'] == '0') ? 'checked' : '' ?>>
                                                        No
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <h4>Destination Settings</h4>
                                    <hr>

                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label for="ac-destination_label" class="col-sm-6 control-label">
                                                Destination Title
                                            </label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="ac-destination_label"
                                                       name="activities[destination_label]">
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label for="ac-destination_phold" class="col-sm-6 control-label">
                                                Destination Placeholder
                                            </label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="ac-destination_phold"
                                                       name="activities[destination_phold]">
                                            </div>
                                        </div>
                                    </div>

                                    <h4>Occupancy Settings</h4>
                                    <hr>

                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label for="ac-adult_count" class="col-sm-6 control-label">
                                                Adult Count
                                            </label>
                                            <div class="col-sm-6">
                                                <select name="activities[adult_count]" class="form-control"
                                                        id="ac-adult_count">
                                                    <?php for ($i = 1; $i <= 20; $i++): ?>
                                                        <option value="<?= $i ?>"><?= $i ?> Adults(s)</option>
                                                    <?php endfor; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label for="ac-child_count" class="col-sm-6 control-label">
                                                Child Count
                                            </label>
                                            <div class="col-sm-6">
                                                <select name="activities[child_count]" class="form-control"
                                                        id="ac-child_count">
                                                    <?php for ($i = 1; $i <= 10; $i++): ?>
                                                        <option value="<?= $i ?>"><?= $i ?> Child(s)</option>
                                                    <?php endfor; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label for="ac-child_age" class="col-sm-6 control-label">
                                                Child Count
                                            </label>
                                            <div class="col-sm-6">
                                                <select name="activities[child_age]" class="form-control"
                                                        id="ac-child_age">
                                                    <?php for ($i = 1; $i <= 17; $i++): ?>
                                                        <option value="<?= $i ?>"><?= $i ?> Years (s)</option>
                                                    <?php endfor; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <h4>Date Settings</h4>
                                    <hr>

                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label for="ac-from_date_label" class="col-sm-6 control-label">
                                                From Date Title
                                            </label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="ac-from_date_label"
                                                       name="activities[from_date_label]">
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label for="ac-to_date_label" class="col-sm-6 control-label">
                                                To Date Title
                                            </label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="ac-to_date_label"
                                                       name="activities[to_date_label]">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="car-rent-widget">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="status" class="col-sm-2 control-label">Show
                                                    Car Rental</label>
                                                <div class="col-sm-6">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="car_rental[status]" id="status-a"
                                                               value="1" <?= ($data['car_rental']['status'] == '1') ? 'checked' : '' ?>>
                                                        Yes
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="car_rental[status]" id="status-b"
                                                               value="0" <?= ($data['car_rental']['status'] == '0') ? 'checked' : '' ?>>
                                                        No
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <h4>Pick-up Settings</h4>
                                    <hr>

                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label for="cr-ret_same_loc_title" class="col-sm-6 control-label">
                                                Return to same Location Title
                                            </label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="cr-ret_same_loc_title"
                                                       name="car_rental[ret_same_loc_title]">
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label for="cr-ret_pickup_type_title" class="col-sm-6 control-label">
                                                Pick-up Type Title
                                            </label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="cr-ret_pickup_type_title"
                                                       name="car_rental[ret_pickup_type_title]">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label for="cr-ret_pickup_title" class="col-sm-6 control-label">
                                                Pick-up Title
                                            </label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="cr-ret_pickup_title"
                                                       name="car_rental[ret_pickup_title]">
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="cr-ret_pickup_pholder" class="col-sm-6 control-label">
                                                Pick-up Placeholder
                                            </label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="cr-ret_pickup_pholder"
                                                       name="car_rental[ret_pickup_pholder]">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label for="cr-ret_pickup_date_title" class="col-sm-6 control-label">
                                                Pick-up Date Title
                                            </label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="cr-ret_pickup_date_title"
                                                       name="car_rental[ret_pickup_date_title]">
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="cr-ret_pickup_time_title" class="col-sm-6 control-label">
                                                Pick-up Time Title
                                            </label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="cr-ret_pickup_time_title"
                                                       name="car_rental[ret_pickup_time_title]">
                                            </div>
                                        </div>
                                    </div>

                                    <h4>Return Settings</h4>
                                    <hr>

                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label for="cr-ret_return_type_title" class="col-sm-6 control-label">
                                                Return Type Title
                                            </label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="cr-ret_return_type_title"
                                                       name="car_rental[ret_return_type_title]">
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label for="cr-ret_return_title" class="col-sm-6 control-label">
                                                Return Title
                                            </label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="cr-ret_return_title"
                                                       name="car_rental[ret_return_title]">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label for="cr-ret_return_pholder" class="col-sm-6 control-label">
                                                Return Placeholder
                                            </label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="cr-ret_return_pholder"
                                                       name="car_rental[ret_return_pholder]">
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="cr-ret_return_date_title" class="col-sm-6 control-label">
                                                Return Date Title
                                            </label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="cr-ret_return_date_title"
                                                       name="car_rental[ret_return_date_title]">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label for="cr-ret_return_time_title" class="col-sm-6 control-label">
                                                Return Time Title
                                            </label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="cr-ret_return_time_title"
                                                       name="car_rental[ret_return_time_title]">
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label for="cr-ret_driver_age_title" class="col-sm-6 control-label">
                                                Driver's Age Title
                                            </label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="cr-ret_driver_age_title"
                                                       name="car_rental[ret_driver_age_title]">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="tab-pane" id="flights-widget">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="status" class="col-sm-2 control-label">Show
                                                    Flights</label>
                                                <div class="col-sm-6">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="flights[status]" id="status-a"
                                                               value="1" <?= ($data['flights']['status'] == '1') ? 'checked' : '' ?>>
                                                        Yes
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="flights[status]" id="status-b"
                                                               value="0" <?= ($data['flights']['status'] == '0') ? 'checked' : '' ?>>
                                                        No
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <h4>Location Settings</h4>
                                    <hr>

                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label for="fl_from_title" class="col-sm-6 control-label">
                                                From Location Title
                                            </label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="fl_from_title"
                                                       name="flights[fl_from_title]">
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label for="fl_from_pholder" class="col-sm-6 control-label">
                                                From Location Placeholder
                                            </label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="fl_from_pholder"
                                                       name="flights[fl_from_pholder]">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label for="fl_to_title" class="col-sm-6 control-label">
                                                To Location Title
                                            </label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="fl_to_title"
                                                       name="flights[fl_to_title]">
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label for="fl_to_pholder" class="col-sm-6 control-label">
                                                To Location Placeholder
                                            </label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="fl_to_pholder"
                                                       name="flights[fl_to_pholder]">
                                            </div>
                                        </div>
                                    </div>

                                    <h4>Dates Settings</h4>
                                    <hr>

                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label for="fl_depature_title" class="col-sm-6 control-label">
                                                Depature Title
                                            </label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="fl_depature_title"
                                                       name="flights[fl_depature_title]">
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label for="fl_arrival_title" class="col-sm-6 control-label">
                                                Arrival Title
                                            </label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="fl_arrival_title"
                                                       name="flights[fl_arrival_title]">
                                            </div>
                                        </div>
                                    </div>

                                    <h4>Other Settings</h4>
                                    <hr>

                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label for="fl_passangers_title" class="col-sm-6 control-label">
                                                Passanger Title
                                            </label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="fl_passangers_title"
                                                       name="flights[fl_passangers_title]">
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label for="fl_ticket_type_title" class="col-sm-6 control-label">
                                                Ticket Type Title
                                            </label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="fl_ticket_type_title"
                                                       name="flights[fl_ticket_type_title]">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label for="fl_trip_type_title" class="col-sm-6 control-label">
                                                Trip Type Title
                                            </label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="fl_trip_type_title"
                                                       name="flights[fl_trip_type_title]">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <hr>
                            <div class="col-sm-12 text-right">
                                <button class="btn btn-primary" type="submit">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var travel_form_data = <?= json_encode($data); ?>;
</script>