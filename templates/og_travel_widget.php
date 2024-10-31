<?php
/**
 * Oganro Travel Widget Generation Page
 */
$is_one = false;
?>

<div class="widget-box">
    <div class="row">
        <div class="col-sm-12">
            <?php if ($data['general']['status']): ?>
                <ul class="nav nav-pills">
                    <?php if ($data['hotel']['status']): ?>
                        <li class="active">
                            <a href="#hotel" data-toggle="tab">
                                <i class="fa fa-h-square fa-2" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">
                                    Hotels
                                </span>
                            </a>
                        </li>
                        <?php $is_one = true; endif; ?>

                        <?php if ($data['transfer']['status']): ?>
                            <li>
                                <a href="#transfer" data-toggle="tab">
                                    <i class="fa fa-taxi fa-2" aria-hidden="true"></i>
                                    <span class="hidden-xs hidden-sm">
                                        Transfer
                                    </span>
                                </a>
                            </li>
                            <?php $is_one = true; endif; ?>
                            <?php if ($data['activities']['status']): ?>
                                <li>
                                    <a href="#activities" data-toggle="tab">
                                        <i class="fa fa-globe" aria-hidden="true"></i>
                                        <span class="hidden-xs hidden-sm">Activities</span>
                                    </a>
                                </li>
                                <?php $is_one = true; endif; ?>
                                <?php if ($data['car_rental']['status']): ?>
                                    <li>
                                        <a href="#car-rent" data-toggle="tab">
                                            <i class="fa fa-car" aria-hidden="true"></i>
                                            <span class="hidden-xs hidden-sm">Car Rental</span>
                                        </a>
                                    </li>
                                    <?php $is_one = true; endif; ?>

                                    <?php if ($data['flights']['status']): ?>
                                        <li>
                                            <a href="#flights" data-toggle="tab">
                                                <i class="fa fa-plane" aria-hidden="true"></i>
                                                <span class="hidden-xs hidden-sm">Flights</span>
                                            </a>
                                        </li>
                                        <?php $is_one = true; endif; ?>
                                    </ul>

                                    <div class="tab-content">
                                        <?php if ($data['hotel']['status']): ?>
                                            <!-- HOTEL PANEL -->
                                            <div class="tab-pane active" id="hotel">
                                                <form id="searchboxform" name="searchboxform" target="_top"
                                                action="<?= $data['general']['ota_url']; ?>/reservation/searchresult!callmdb.html"
                                                data-toggle="validator" accept-charset="utf-8">

                                                <input type="hidden" name="hotelMappingId" value="0" id="hotelMappingId"/>
                                                <input type="hidden" name="changedfiled" value="" id="changedfiled"/>
                                                <input type="hidden" name="showcity" value="true" id="showcity"/>
                                                <input type="hidden" name="reqcurrency" value="USD" id="box_reqcurrency"/>
                                                <input type="hidden" name="cityName" value="" id="cityName"/>
                                                <input type="hidden" name="cityId" value="0" id="cityId"/>
                                                <input type="hidden" name="datefrom" value="" id="datefrom"/>
                                                <input type="hidden" name="dateto" value="" id="dateto"/>
                                                <input type="hidden" name="noofnights" value="" id="noofnights"/>
                                                <input type="hidden" name="starrate" value="-2" id="starrate"/>
                                                <input type="hidden" name="noofrooms" value="1" id="noofrooms"/>

                                                <div id="search_box_main_wrap">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 destination modal-adjust">
                                                            <div class="form-group">
                                                                <label><?= $data['hotel']['ht_location_title']; ?></label>
                                                                <input id="autocompleter_city" name="autocompleter_city" type="search"
                                                                class="form-control" results="0"
                                                                placeholder="<?= $data['hotel']['ht_location_pholder']; ?>"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 date_inputs modal-adjust">
                                                            <div class="form-group">
                                                                <label><?= $data['hotel']['ht_checkin_title']; ?></label>
                                                                <div class="input-group date from_date">

                                                                    <input id="tmp_date_from" name="tmp_date_from" type="text"
                                                                    class="form-control" required readonly/>
                                                                    <span class="input-group-addon"><i class="fa fa-calendar fa-2"
                                                                     aria-hidden="true"></i></span>

                                                                 </div>
                                                             </div>
                                                         </div>
                                                         <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 date_inputs modal-adjust">
                                                            <div class="form-group">
                                                                <label><?= $data['hotel']['ht_checkout_title']; ?></label>
                                                                <div class="input-group date to_date">
                                                                    <input id="tmp_date_to" name="tmp_date_to" type="text"
                                                                    class="form-control" required readonly/>
                                                                    <span class="input-group-addon"><i class="fa fa-calendar fa-2"
                                                                     aria-hidden="true"></i></span>
                                                                 </div>
                                                             </div>
                                                         </div>
                                                     </div>
                                                     <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 nights modal-adjust">
                                                            <div class="form-group full-width">
                                                                <label><?= $data['hotel']['ht_nights_title']; ?></label>
                                                                <div class="dropdown input-group full-width" id="nightsDrpdwn">
                                                                    <button class="btn btn-default dropdown-toggle full-width"
                                                                    type="button" id="nightsDrpdwnBtn"
                                                                    data-toggle="dropdown"></button>
                                                                    <ul class="dropdown-menu scrollable-menu" role="menu"
                                                                    aria-labelledby="nightsDrpdwn" id="nightsDrpdwnUl">
                                                                    <?php $nights = (int)$data['hotel']['ht_nights_count']; ?>
                                                                    <?php for ($n = 1; $n <= $nights; $n++): ?>
                                                                        <li role="presentation">
                                                                            <a role="menuitem" tabindex="-1" data-value="<?= $n ?>">
                                                                                <?= $n ?></a>
                                                                            </li>
                                                                        <?php endfor; ?>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 rooms modal-adjust">
                                                            <div class="form-group">
                                                                <label class="control-label" for="exampleInputEmail1">Rooms</label>
                                                                <div class="dropdown input-group searchbox_fullwidthbtn"
                                                                id="noOfRoomsDrpdwn">

                                                                <button class="btn btn-default dropdown-toggle btn-block triggerx"
                                                                type="button"
                                                                id="noOfRoomsDrpdwnBtn" data-toggle="dropdown" value="-1">
                                                                1 room, 2 adults &nbsp;
                                                                <span class="glyphicon glyphicon-chevron-down"></span>
                                                            </button>
                                                            <ul class="dropdown-menu" role="menu"
                                                            aria-labelledby="noOfRoomsDrpdwn" id="noOfRoomsDrpdwnUl">
                                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                             data-value="-1">
                                                             1 room, 2 adults</a></li>
                                                             <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                 data-value="-2">
                                                                 1 room, 1 adult</a></li>
                                                                 <li role="presentation" class="divider"></li>
                                                                 <li role="presentation" class="dropdown-header">More Options
                                                                 </li>
                                                                 <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                     data-value="1">
                                                                     1&nbsp;Room</a></li>

                                                                     <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                         data-value="2">
                                                                         2&nbsp;Rooms</a></li>

                                                                         <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                             data-value="3">
                                                                             3&nbsp;Rooms</a></li>

                                                                             <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                 data-value="4">
                                                                                 4&nbsp;Rooms</a></li>

                                                                                 <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                     data-value="5">
                                                                                     5&nbsp;Rooms</a></li>

                                                                                 </ul>

                                                                                 <div id="popoverwrap" class="searchbox_popover">
                                                                                    <div class="head hide">Room Occupancy Details</div>
                                                                                    <div id="popovercontent" class="content hide">
                                                                                        <div class="popoversecdiv">
                                                                                            <div class="popoversecdivroom">
                                                                                                <div>Room&nbsp;1:&nbsp;</div>
                                                                                                <div>
                                                                                                    <div class="badge popadults">2</div>
                                                                                                    <span class="seacrhpopover_adults">Adults</span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 hotel-go">
                                                                        <div class="form-group">
                                                                            <label class="hidden-xs">&nbsp;</label>
                                                                            <button class="btn pull-right hotel-btn btn-submit" type="submit">
                                                                                search
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- OCCUPANCY MODAL -->
                                                            <div id="rmOccupancyModal" class="modal fade bs-example-modal-sm" tabindex="-1"
                                                            role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-sm">

                                                                <div class="modal-content">
                                                                    <!-- MODAL HEADER -->
                                                                    <div class="modal-header">
                                                                        <button id="rmOccupancyClose" type="button" class="close"
                                                                        data-dismiss="modal">
                                                                        <span aria-hidden="true">&times;</span>
                                                                        <span class="sr-only">Close</span>
                                                                    </button>
                                                                    <h4 class="modal-title" id="rmOccupancyModalLabel">Room Occupancy</h4>
                                                                </div>
                                                                <!-- MODAL HEADER :: END -->

                                                                <div class="modal-body searchbox_roomresult_pop">
                                                                    <?php for ($i = 1;
                                                                     $i <= 5;
                                                                     $i++): ?>
                                                                     <div class="row">
                                                                        <div class="col-sm-12">
                                                                            <div class="dropdown"
                                                                            style="display: <?= ($i == 1) ? 'block' : 'none'; ?>;"
                                                                            id="adultsDwn_<?= $i; ?>">

                                                                            <div class="wi-block">
                                                                                <span class="label label-warning"> Room:&nbsp;
                                                                                    <span class="special_englishfont_load"><?= $i; ?></span>
                                                                                </span>
                                                                            </div>

                                                                            <button class="btn btn-default btn-block dropdown-toggle "
                                                                            type="button" id="adultsDrpdwnBtn"
                                                                            data-toggle="dropdown" value="2"> 2&nbsp; Adults
                                                                            <span class="glyphicon glyphicon-chevron-down"></span>
                                                                        </button>

                                                                        <ul class="dropdown-menu" role="menu"
                                                                        aria-labelledby="adultsDrpdwn" id="adultsDrpdwnUl">

                                                                        <?php for ($adult = 1; $adult <= 4; $adult++): ?>

                                                                            <li role="presentation">
                                                                                <a role="menuitem" tabindex="-1"
                                                                                data-value="<?= $adult; ?>">
                                                                                <?= $adult; ?> Adult(s)</a>
                                                                            </li>
                                                                        <?php endfor; ?>
                                                                    </ul>

                                                                    <input type="hidden" name="adults" value="2"
                                                                    id="adults">
                                                                </div>
                                                                <div class="dropdown"
                                                                style="display: <?= ($i == 1) ? 'block' : 'none'; ?>;"
                                                                id="childrenDropDwn_<?= $i; ?>">
                                                                <div class=""
                                                                style="margin-bottom: 5px; margin-top: 5px;"><span
                                                                class="label label-primary">1 - 17 years old</span>
                                                            </div>
                                                            <button class="btn btn-default btn-block dropdown-toggle "
                                                            type="button" id="childrenDrpdwnBtn"
                                                            data-toggle="dropdown" value="0">
                                                            Children
                                                            <span class="glyphicon glyphicon-chevron-down"></span>
                                                        </button>

                                                        <ul class="dropdown-menu" role="menu"
                                                        aria-labelledby="childrenDrpdwn"
                                                        id="childrenDrpdwnUl">

                                                        <?php for ($children = 1; $children <= 3; $children++): ?>

                                                            <li role="presentation">
                                                                <a role="menuitem" tabindex="-1"
                                                                data-value="<?= $children; ?>">
                                                                <?= $children; ?> Children
                                                            </a>
                                                        </li>

                                                    <?php endfor; ?>
                                                </ul>

                                                <input type="hidden" name="children" value="0"
                                                id="children">
                                            </div>
                                            <div class="age_lbl_cls ageLblToggle"
                                            id="age_lbl_<?= $i; ?>"
                                            style="display: none;">
                                            <div style="margin-bottom: 5px; margin-top: 5px;"><span>Child Age ( at check-in )</span>
                                            </div>
                                        </div>

                                        <?php for ($age_row = 1; $age_row <= 3; $age_row++): ?>
                                            <span class="dropdown ageDropDwnToggle ageRawToggle_<?= $i; ?>"
                                              style="display: none;"
                                              id="ageDropDwn_<?= $i; ?>_<?= $age_row; ?>">

                                              <button class="btn btn-default dropdown-toggle special_englishfont_load"
                                              type="button" id="ageDrpdwnBtn"
                                              data-toggle="dropdown" value="<?= $i; ?>"><?= $i; ?>
                                              <span class="glyphicon glyphicon-chevron-down"></span>
                                          </button>

                                          <ul class="dropdown-menu scrollable-menu special_englishfont_load"
                                          role="menu" aria-labelledby="ageDrpdwn"
                                          id="ageDrpdwnUl">
                                          <?php for ($age = 1; $age <= 17; $age++): ?>
                                              <li role="presentation">
                                                <a role="menuitem" tabindex="-1"
                                                data-value="<?= $age; ?>"><?= $age; ?></a>
                                            </li>
                                        <?php endfor; ?>
                                    </ul>

                                    <input type="hidden" name="age" value="<?= $i; ?>" id="age"
                                    disabled="disabled">
                                </span>
                            <?php endfor; ?>
                        </div>


                    </div>
                <?php endfor; ?>
            </div>

            <!-- MODAL FOOTER -->
            <div class="modal-footer">
                <button type="button" id="updateRoomsBtn" class="btn btn-primary">Update
                </button>
            </div>
            <!-- MODAL FOOTER :: END -->
        </div>
    </div>
</div>
<!-- OCCUPANCY MODAL :: END -->
</form>
</div>
<!-- HOTEL PANEL :: ENDS -->
<?php endif; ?>

<?php if ($data['transfer']['status']): ?>
    <!-- TRANSFER PANEL -->
    <div class="tab-pane" id="transfer">
        <form id="searchboxform_transfer" name="searchboxform_transfer"
        action="<?= $data['general']['ota_url']; ?>/reservation/transfersearchresult!callmdb.html"
        data-toggle="validator" accept-charset="utf-8">

        <input type="hidden" name="reqcurrency" value="USD" id="reqcurrency"/>
        <input type="hidden" name="transferOptionType" value="ROUND_TRIP"
        id="transferOptionType"/>

        <input type="hidden" name="pickupLocationCode" value="0" id="pickupLocationCode"/>
        <input type="hidden" name="pickupLocationTxt" value="" id="pickupLocationTxt"/>
        <input type="hidden" name="pickupLocationType" value="TERMINAL"
        id="pickupLocationType"/>

        <input type="hidden" name="dropoffLocationCode" value="0" id="dropoffLocationCode"/>
        <input type="hidden" name="dropoffLocationTxt" value="" id="dropoffLocationTxt"/>
        <input type="hidden" name="dropoffLocationType" value="ACCOMMODATION"
        id="dropoffLocationType"/>

        <input type="hidden" name="pickupDate" value="" id="pickupDate"/>
        <input type="hidden" name="pickupDateOriginal" value="" id="pickupDateOriginal"/>

        <input type="hidden" name="returnDate" value="" id="returnDate"/>
        <input type="hidden" name="returnDateOriginal" value="" id="returnDateOriginal"/>

        <input type="hidden" name="noOfAdults_transfer" value="1" id="noOfAdults_transfer"/>
        <input type="hidden" name="noOfChildren_transfer" value="0" id="noOfChildren_transfer"/>


        <input type="hidden" name="pickupCountryId" value="" id="pickupCountryId"/>
        <input type="hidden" name="pickupCityId" value="" id="pickupCityId"/>
        <input type="hidden" name="pickupHotelId" value="" id="pickupHotelId"/>
        <input type="hidden" name="pickupTerminalId" value="" id="pickupTerminalId"/>


        <input type="hidden" name="dropoffCountryId" value="" id="dropoffCountryId"/>
        <input type="hidden" name="dropoffCityId" value="" id="dropoffCityId"/>
        <input type="hidden" name="dropoffHotelId" value="" id="dropoffHotelId"/>
        <input type="hidden" name="dropoffTerminalId" value="" id="dropoffTerminalId"/>


        <div id="search_box_main_wrap">
            <div class="row">
                <div class="form-group col-sm-12">
                    <label class="checkbox-inline">
                        <input type="radio" name="transferOption" id="transferOption_R"
                        value="ROUND_TRIP" checked=""> Round Trip
                    </label>

                    <label class="checkbox-inline">
                        <input type="radio" name="transferOption" id="transferOption_O"
                        value="ONE_WAY"> One Way
                    </label>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-sm-12 col-xs-12 col-md-6">
                    <label><?= $data['transfer']['pickup_loc_title']; ?></label>
                    <input id="autocompleter_pickup" name="autocompleter_pickup" type="search"
                    class="form-control"
                    placeholder="<?= $data['transfer']['pickup_loc_pholder']; ?>">
                </div>

                <div class="form-group col-sm-12 col-xs-12 col-md-6">
                    <label><?= $data['transfer']['drop_loc_title']; ?></label>
                    <input id="autocompleter_dropoff" name="autocompleter_dropoff" type="search"
                    class="form-control"
                    placeholder="<?= $data['transfer']['drop_loc_pholder']; ?>">
                </div>
            </div>

            <div class="row">

                <div class="form-group col-md-4 col-sm-4 col-xs-6">
                    <label>Adults</label>
                    <div class="dropdown" id="adultsDrpdwn_transfer">
                        <button class="btn btn-default dropdown-toggle btn-block" type="button"
                        id="adultsDrpdwnBtn_transfer" data-toggle="dropdown">
                        1 &nbsp;Adult &nbsp;
                        <span class="glyphicon glyphicon-chevron-down"></span>
                    </button>

                    <ul class="dropdown-menu scrollable-menu" role="menu"
                    aria-labelledby="adultsDrpdwn_transfer"
                    id="adultsDrpdwnUl_transfer">

                    <?php for ($adults = 1; $adults <= 6; $adults++): ?>
                        <li role="presentation"><a role="menuitem" tabindex="-1"
                         href="javascript:void(0);"
                         data-value="<?= $adults ?>">
                         <?= $adults ?> </a></li>
                     <?php endfor ?>
                 </ul>

             </div>
         </div>

         <div class="form-group col-md-4 col-sm-4 col-xs-6">
            <label>Children</label>
            <div class="dropdown" id="childrenDrpdwn_transfer">
                <button class="btn btn-default dropdown-toggle btn-block" type="button"
                id="childrenDrpdwnBtn_transfer" data-toggle="dropdown">
                0 &nbsp;Child &nbsp;
                <span class="glyphicon glyphicon-chevron-down"></span>
            </button>
            <ul class="dropdown-menu scrollable-menu" role="menu"
            aria-labelledby="childrenDrpdwn_transfer"
            id="childrenDrpdwnUl_transfer">

            <li role="presentation"><a role="menuitem" tabindex="-1"
             href="javascript:void(0);"
             data-value="0">
             0 </a></li>

             <li role="presentation"><a role="menuitem" tabindex="-1"
                 href="javascript:void(0);"
                 data-value="1">
                 1 </a></li>

                 <li role="presentation"><a role="menuitem" tabindex="-1"
                     href="javascript:void(0);"
                     data-value="2">
                     2 </a></li>

                     <li role="presentation"><a role="menuitem" tabindex="-1"
                         href="javascript:void(0);"
                         data-value="3">
                         3 </a></li>

                     </ul>
                 </div>
             </div>

             <div class="form-group col-md-4 col-sm-4 col-xs-12"
             id="agesDiv" style="display: none;">
             <label>Age of Children</label>
             <div class="input-group">
                <?php for ($chage = 1; $chage <= 3; $chage++): ?>
                    <div class="dropdown"
                    id="agesDrpdwn_transfer_<?= $chage; ?>" style="display: none;">
                    <button class="btn btn-default dropdown-toggle btn-block"
                    type="button"
                    id="agesDrpdwnBtn_transfer" data-toggle="dropdown">
                    <?= $chage; ?>
                    <span class="glyphicon glyphicon-chevron-down"></span>
                </button>
                <ul class="dropdown-menu scrollable-menu" role="menu"
                aria-labelledby="agesDrpdwn_transfer"
                id="agesDrpdwnUl_transfer">

                <?php for ($age = 1; $age <= 18; $age++): ?>
                    <li role="presentation">
                        <a role="menuitem"
                        tabindex="-1" href="javascript:void(0);"
                        data-value="<?= $age; ?>"><?= $age; ?> </a>
                    </li>
                <?php endfor; ?>

            </ul>
            <input type="hidden" name="age_transfer" value="1"
            id="age_transfer"
            disabled="disabled"/>
        </div>
    <?php endfor; ?>
</div>
</div>

<div class="form-group col-md-4 col-sm-6 col-xs-6">
    <label><?= $data['transfer']['pickup_dat_title']; ?></label>
    <div class="input-group date pickup_date">
        <input id="tmp_date_pickup_date" name="tmp_date_pickup_date" type="text"
        class="form-control" required readonly/>
        <span class="input-group-addon"><i
            class="glyphicon glyphicon-calendar"></i></span>
        </div>
    </div>

    <div class="form-group col-md-4 col-sm-6 col-xs-6" id="returnDateDiv">
        <label><?= $data['transfer']['return_dat_title']; ?></label>
        <div class="input-group date return_date">
            <input id="tmp_date_return_date" name="tmp_date_return_date" type="text"
            class="form-control" required readonly/>
            <span class="input-group-addon"><i
                class="glyphicon glyphicon-calendar"></i></span>
            </div>
        </div>

        <div class="form-group col-md-4 col-sm-6 col-xs-12">
            <label id="pickupTimeBtn_hhlbl" class="control-label"
            for="pickupTimeBtn_hh">
            <?= $data['transfer']['pickup_time_title']; ?>
        </label>
        <div class="input-group">
            <div class="dropdown date pull-left" id="pickupTime_hh">
                <button class="btn btn-default dropdown-toggle btn-block"
                type="button"
                id="pickupTimeBtn_hh" name="pickupTimeBtn_hh"
                data-toggle="dropdown">
                00 hh &nbsp;
                <span class="glyphicon glyphicon-chevron-down"></span>
            </button>
            <ul class="dropdown-menu scrollable-menu" role="menu"
            aria-labelledby="pickupTimeBtn_hh" id="pickupTimeUl_hh">

            <li role="presentation"><a role="menuitem" tabindex="-1"
             href="javascript:void(0);"
             data-value="00">
             00 </a></li>

             <li role="presentation"><a role="menuitem" tabindex="-1"
                 href="javascript:void(0);"
                 data-value="01">
                 01 </a></li>

                 <li role="presentation"><a role="menuitem" tabindex="-1"
                     href="javascript:void(0);"
                     data-value="02">
                     02 </a></li>

                     <li role="presentation"><a role="menuitem" tabindex="-1"
                         href="javascript:void(0);"
                         data-value="03">
                         03 </a></li>

                         <li role="presentation"><a role="menuitem" tabindex="-1"
                             href="javascript:void(0);"
                             data-value="04">
                             04 </a></li>

                             <li role="presentation"><a role="menuitem" tabindex="-1"
                                 href="javascript:void(0);"
                                 data-value="05">
                                 05 </a></li>

                                 <li role="presentation"><a role="menuitem" tabindex="-1"
                                     href="javascript:void(0);"
                                     data-value="06">
                                     06 </a></li>

                                     <li role="presentation"><a role="menuitem" tabindex="-1"
                                         href="javascript:void(0);"
                                         data-value="07">
                                         07 </a></li>

                                         <li role="presentation"><a role="menuitem" tabindex="-1"
                                             href="javascript:void(0);"
                                             data-value="08">
                                             08 </a></li>

                                             <li role="presentation"><a role="menuitem" tabindex="-1"
                                                 href="javascript:void(0);"
                                                 data-value="09">
                                                 09 </a></li>

                                                 <li role="presentation"><a role="menuitem" tabindex="-1"
                                                     href="javascript:void(0);"
                                                     data-value="10">
                                                     10 </a></li>

                                                     <li role="presentation"><a role="menuitem" tabindex="-1"
                                                         href="javascript:void(0);"
                                                         data-value="11">
                                                         11 </a></li>

                                                         <li role="presentation"><a role="menuitem" tabindex="-1"
                                                             href="javascript:void(0);"
                                                             data-value="12">
                                                             12 </a></li>

                                                             <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                 href="javascript:void(0);"
                                                                 data-value="13">
                                                                 13 </a></li>

                                                                 <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                     href="javascript:void(0);"
                                                                     data-value="14">
                                                                     14 </a></li>

                                                                     <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                         href="javascript:void(0);"
                                                                         data-value="15">
                                                                         15 </a></li>

                                                                         <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                             href="javascript:void(0);"
                                                                             data-value="16">
                                                                             16 </a></li>

                                                                             <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                 href="javascript:void(0);"
                                                                                 data-value="17">
                                                                                 17 </a></li>

                                                                                 <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                     href="javascript:void(0);"
                                                                                     data-value="18">
                                                                                     18 </a></li>

                                                                                     <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                         href="javascript:void(0);"
                                                                                         data-value="19">
                                                                                         19 </a></li>

                                                                                         <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                             href="javascript:void(0);"
                                                                                             data-value="20">
                                                                                             20 </a></li>

                                                                                             <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                 href="javascript:void(0);"
                                                                                                 data-value="21">
                                                                                                 21 </a></li>

                                                                                                 <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                     href="javascript:void(0);"
                                                                                                     data-value="22">
                                                                                                     22 </a></li>

                                                                                                     <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                         href="javascript:void(0);"
                                                                                                         data-value="23">
                                                                                                         23 </a></li>

                                                                                                     </ul>
                                                                                                     <input type="hidden" name="pickuphh" value="00" id="pickuphh"/>
                                                                                                 </div>
                                                                                                 <div class="dropdown date pull-right" id="pickupTime_mm">
                                                                                                    <button class="btn btn-default dropdown-toggle btn-block"
                                                                                                    type="button"
                                                                                                    id="pickupTimeBtn_mm" data-toggle="dropdown" value="00">
                                                                                                    00 mm &nbsp;
                                                                                                    <span class="glyphicon glyphicon-chevron-down"></span>
                                                                                                </button>
                                                                                                <ul class="dropdown-menu scrollable-menu" role="menu"
                                                                                                aria-labelledby="pickupTimeBtn_mm" id="pickupTimeUl_mm">

                                                                                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                 href="javascript:void(0);"
                                                                                                 data-value="00">
                                                                                                 00 </a></li>

                                                                                                 <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                     href="javascript:void(0);"
                                                                                                     data-value="15">
                                                                                                     15 </a></li>

                                                                                                     <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                         href="javascript:void(0);"
                                                                                                         data-value="30">
                                                                                                         30 </a></li>

                                                                                                         <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                             href="javascript:void(0);"
                                                                                                             data-value="45">
                                                                                                             45 </a></li>

                                                                                                         </ul>
                                                                                                         <input type="hidden" name="pickupmm" value="00" id="pickupmm"/>
                                                                                                     </div>
                                                                                                 </div>
                                                                                             </div>

                                                                                             <div class="col-md-4 col-sm-6 col-xs-12" id="returnDestTimeDiv">
                                                                                                <label><?= $data['transfer']['return_time_title']; ?></label>
                                                                                                <div class="input-group">
                                                                                                    <div class="dropdown date pull-left" id="returndestTime_hh">
                                                                                                        <button class="btn btn-default btn-block dropdown-toggle btn-block"
                                                                                                        type="button" id="returndestTimeBtn_hh"
                                                                                                        data-toggle="dropdown">
                                                                                                        00 hh &nbsp;
                                                                                                        <span class="glyphicon glyphicon-chevron-down"></span>
                                                                                                    </button>
                                                                                                    <ul class="dropdown-menu scrollable-menu" role="menu"
                                                                                                    aria-labelledby="returndestTimeBtn_hh" id="returndestTimeUl_hh">

                                                                                                    <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                     href="javascript:void(0);"
                                                                                                     data-value="00">
                                                                                                     00 </a></li>

                                                                                                     <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                         href="javascript:void(0);"
                                                                                                         data-value="01">
                                                                                                         01 </a></li>

                                                                                                         <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                             href="javascript:void(0);"
                                                                                                             data-value="02">
                                                                                                             02 </a></li>

                                                                                                             <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                                 href="javascript:void(0);"
                                                                                                                 data-value="03">
                                                                                                                 03 </a></li>

                                                                                                                 <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                                     href="javascript:void(0);"
                                                                                                                     data-value="04">
                                                                                                                     04 </a></li>

                                                                                                                     <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                                         href="javascript:void(0);"
                                                                                                                         data-value="05">
                                                                                                                         05 </a></li>

                                                                                                                         <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                                             href="javascript:void(0);"
                                                                                                                             data-value="06">
                                                                                                                             06 </a></li>

                                                                                                                             <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                                                 href="javascript:void(0);"
                                                                                                                                 data-value="07">
                                                                                                                                 07 </a></li>

                                                                                                                                 <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                                                     href="javascript:void(0);"
                                                                                                                                     data-value="08">
                                                                                                                                     08 </a></li>

                                                                                                                                     <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                                                         href="javascript:void(0);"
                                                                                                                                         data-value="09">
                                                                                                                                         09 </a></li>

                                                                                                                                         <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                                                             href="javascript:void(0);"
                                                                                                                                             data-value="10">
                                                                                                                                             10 </a></li>

                                                                                                                                             <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                                                                 href="javascript:void(0);"
                                                                                                                                                 data-value="11">
                                                                                                                                                 11 </a></li>

                                                                                                                                                 <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                                                                     href="javascript:void(0);"
                                                                                                                                                     data-value="12">
                                                                                                                                                     12 </a></li>

                                                                                                                                                     <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                                                                         href="javascript:void(0);"
                                                                                                                                                         data-value="13">
                                                                                                                                                         13 </a></li>

                                                                                                                                                         <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                                                                             href="javascript:void(0);"
                                                                                                                                                             data-value="14">
                                                                                                                                                             14 </a></li>

                                                                                                                                                             <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                                                                                 href="javascript:void(0);"
                                                                                                                                                                 data-value="15">
                                                                                                                                                                 15 </a></li>

                                                                                                                                                                 <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                                                                                     href="javascript:void(0);"
                                                                                                                                                                     data-value="16">
                                                                                                                                                                     16 </a></li>

                                                                                                                                                                     <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                                                                                         href="javascript:void(0);"
                                                                                                                                                                         data-value="17">
                                                                                                                                                                         17 </a></li>

                                                                                                                                                                         <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                                                                                             href="javascript:void(0);"
                                                                                                                                                                             data-value="18">
                                                                                                                                                                             18 </a></li>

                                                                                                                                                                             <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                                                                                                 href="javascript:void(0);"
                                                                                                                                                                                 data-value="19">
                                                                                                                                                                                 19 </a></li>

                                                                                                                                                                                 <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                                                                                                     href="javascript:void(0);"
                                                                                                                                                                                     data-value="20">
                                                                                                                                                                                     20 </a></li>

                                                                                                                                                                                     <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                                                                                                         href="javascript:void(0);"
                                                                                                                                                                                         data-value="21">
                                                                                                                                                                                         21 </a></li>

                                                                                                                                                                                         <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                                                                                                             href="javascript:void(0);"
                                                                                                                                                                                             data-value="22">
                                                                                                                                                                                             22 </a></li>

                                                                                                                                                                                             <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                                                                                                                 href="javascript:void(0);"
                                                                                                                                                                                                 data-value="23">
                                                                                                                                                                                                 23 </a></li>

                                                                                                                                                                                             </ul>
                                                                                                                                                                                             <input type="hidden" name="returnDesthh" value="00"
                                                                                                                                                                                             id="returnDesthh"/>
                                                                                                                                                                                         </div>
                                                                                                                                                                                         <div class="dropdown date pull-right" id="returndestTime_mm">
                                                                                                                                                                                            <button class="btn btn-default dropdown-toggle btn-block"
                                                                                                                                                                                            type="button"
                                                                                                                                                                                            id="returndestTimeBtn_mm" data-toggle="dropdown" value="00">
                                                                                                                                                                                            00 mm &nbsp;
                                                                                                                                                                                            <span class="glyphicon glyphicon-chevron-down"></span>
                                                                                                                                                                                        </button>
                                                                                                                                                                                        <ul class="dropdown-menu scrollable-menu" role="menu"
                                                                                                                                                                                        aria-labelledby="returndestTimeBtn_mm" id="returndestTimeUl_mm">

                                                                                                                                                                                        <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                                                                                                         href="javascript:void(0);"
                                                                                                                                                                                         data-value="00">
                                                                                                                                                                                         00 </a></li>

                                                                                                                                                                                         <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                                                                                                             href="javascript:void(0);"
                                                                                                                                                                                             data-value="15">
                                                                                                                                                                                             15 </a></li>

                                                                                                                                                                                             <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                                                                                                                 href="javascript:void(0);"
                                                                                                                                                                                                 data-value="30">
                                                                                                                                                                                                 30 </a></li>

                                                                                                                                                                                                 <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                                                                                                                                     href="javascript:void(0);"
                                                                                                                                                                                                     data-value="45">
                                                                                                                                                                                                     45 </a></li>

                                                                                                                                                                                                 </ul>
                                                                                                                                                                                                 <input type="hidden" name="returnDestmm" value="00"
                                                                                                                                                                                                 id="returnDestmm"/>
                                                                                                                                                                                             </div>
                                                                                                                                                                                         </div>

                                                                                                                                                                                     </div>

                                                                                                                                                                                     <div class="form-group col-md-4 col-sm-12 col-xs-12">
                                                                                                                                                                                        <label class="hidden-xs">&nbsp;</label>
                                                                                                                                                                                        <button class="btn btn-block btn-submit transfer-btn" type="submit">
                                                                                                                                                                                            search
                                                                                                                                                                                        </button>
                                                                                                                                                                                    </div>
                                                                                                                                                                                </div>
                                                                                                                                                                            </div>

                                                                                                                                                                            <!-- Pickup Destination pop up modal -->
                                                                                                                                                                            <div id="pickupDestinationDiv"
                                                                                                                                                                            class="searchpopupwrap modal fade" tabindex="-1"
                                                                                                                                                                            role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                                                                                                                                            <div class="modal-dialog">

                                                                                                                                                                                <div class="modal-content">

                                                                                                                                                                                    <div class="modal-header" id="pickupDestinationHeaderDiv">
                                                                                                                                                                                        <button type="button" class="close" data-dismiss="modal"
                                                                                                                                                                                        aria-label="Close">
                                                                                                                                                                                        <span aria-hidden="true">&times;</span></button>
                                                                                                                                                                                        <h5 class="modal-title"></h5>
                                                                                                                                                                                    </div>


                                                                                                                                                                                    <div id="" class="modal-body">

                                                                                                                                                                                        <div class="row">
                                                                                                                                                                                            <div class="form-group col-sm-12">
                                                                                                                                                                                                <label class="checkbox-inline">
                                                                                                                                                                                                    <input type="radio" name="pickupLocation"
                                                                                                                                                                                                    id="pickupLocation_A" value="ACCOMMODATION">
                                                                                                                                                                                                    Accommodation
                                                                                                                                                                                                </label>

                                                                                                                                                                                                <label class="checkbox-inline">
                                                                                                                                                                                                    <input type="radio" name="pickupLocation"
                                                                                                                                                                                                    id="pickupLocation_T" value="TERMINAL" checked>
                                                                                                                                                                                                    Terminal
                                                                                                                                                                                                </label>
                                                                                                                                                                                            </div>
                                                                                                                                                                                        </div>

                                                                                                                                                                                        <div class="row">
                                                                                                                                                                                            <div class="col-md-6 col-sm-12" id="pickupCountryDiv">
                                                                                                                                                                                                <div class="form-group">
                                                                                                                                                                                                    <label>Country</label> <span role="status"
                                                                                                                                                                                                    aria-live="polite"
                                                                                                                                                                                                    class="ui-helper-hidden-accessible"></span><input
                                                                                                                                                                                                    id="autocompleter_country_pickup"
                                                                                                                                                                                                    name="autocompleter_country_pickup" type="search"
                                                                                                                                                                                                    class="form-control ui-autocomplete-input"
                                                                                                                                                                                                    placeholder="Country" required=""
                                                                                                                                                                                                    oninvalid="this.setCustomValidity('Please select a country')"
                                                                                                                                                                                                    autocomplete="off">
                                                                                                                                                                                                    <input type="hidden" name="pickupCountryName" value=""
                                                                                                                                                                                                    id="pickupCountryName">
                                                                                                                                                                                                </div>
                                                                                                                                                                                            </div>

                                                                                                                                                                                            <div class="col-md-6 col-sm-12" id="pickupCityDiv"
                                                                                                                                                                                            style="display: none;">
                                                                                                                                                                                            <div class="form-group">
                                                                                                                                                                                                <label>City</label> <span role="status" aria-live="polite"
                                                                                                                                                                                                class="ui-helper-hidden-accessible"></span><input
                                                                                                                                                                                                id="autocompleter_city_pickup"
                                                                                                                                                                                                name="autocompleter_city_pickup" type="search"
                                                                                                                                                                                                class="form-control ui-autocomplete-input"
                                                                                                                                                                                                placeholder="City" disabled="disabled" required=""
                                                                                                                                                                                                oninvalid="this.setCustomValidity('Please select a city')"
                                                                                                                                                                                                autocomplete="off">
                                                                                                                                                                                                <input type="hidden" name="pickupCityName" value=""
                                                                                                                                                                                                id="pickupCityName">
                                                                                                                                                                                            </div>

                                                        <!-- required
                                                        oninvalid="this.setCustomValidity('Please select a city')" -->
                                                    </div>

                                                    <div class="col-md-6 col-sm-12" id="pickupAccommodationDiv"
                                                    style="display: none;">
                                                    <div class="form-group">
                                                        <label>Accommodation</label> <span role="status"
                                                        aria-live="polite"
                                                        class="ui-helper-hidden-accessible"></span><input
                                                        id="autocompleter_accommodation_pickup"
                                                        name="autocompleter_accommodation_pickup"
                                                        type="search"
                                                        class="form-control ui-autocomplete-input"
                                                        placeholder="Accommodation" disabled="disabled"
                                                        required=""
                                                        oninvalid="this.setCustomValidity('Please select an Accommodation')"
                                                        autocomplete="off">
                                                        <input type="hidden" name="pickupHotelName" value=""
                                                        id="pickupHotelName">
                                                    </div>
                                                        <!-- required
                                                        oninvalid="this.setCustomValidity('Please select a accommodation')" -->
                                                    </div>


                                                    <div class="col-md-6 col-sm-12" id="pickupTerminalDiv">
                                                        <div class="form-group">
                                                            <label>Terminal</label> <span role="status"
                                                            aria-live="polite"
                                                            class="ui-helper-hidden-accessible"></span><input
                                                            id="autocompleter_terminal_pickup"
                                                            name="autocompleter_terminal_pickup" type="search"
                                                            class="form-control ui-autocomplete-input"
                                                            placeholder="Terminal" disabled="disabled"
                                                            required=""
                                                            oninvalid="this.setCustomValidity('Please select a Terminal')"
                                                            autocomplete="off">
                                                            <input type="hidden" name="pickupTerminalName" value=""
                                                            id="pickupTerminalName">
                                                        </div>
                                                    </div>

                                                </div>


                                            </div>

                                            <div class="modal-footer">
                                                <button id="pickupSearchLocation" class="btn btn-primary btn-submit"
                                                name="pickupSearchLocation"
                                                type="button">
                                                Update
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Pickup Destination pop up modal :: end -->

                            <!-- Drop Destination pop up modal-->
                            <div id="dropoffDestinationDiv"
                            class="searchpopupwrap modal fade" tabindex="-1"
                            role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content" style="background: #ffffff;">
                                    <div class="modal-header nopadding roomalocatepopuphead"
                                    id="dropoffDestinationHeaderDiv">
                                    <button type="button" class="close" data-dismiss="modal">
                                        <span aria-hidden="true">&times;</span><span class="sr-only"></span>
                                    </button>
                                    <h5 class="text-center"></h5>

                                </div>


                                <div id="" class="modal-body">
                                    <div class="row">

                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label class="checkbox-inline">
                                                    <input type="radio" name="dropoffLocation"
                                                    id="dropoffLocation_A"
                                                    value="ACCOMMODATION" checked> Accommodation
                                                </label>

                                                <label class="checkbox-inline">
                                                    <input type="radio" name="dropoffLocation"
                                                    id="dropoffLocation_T" value="TERMINAL">
                                                    Terminal
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12" id="dropoffCountryDiv">
                                            <div class="form-group">
                                                <label>Country</label> <input
                                                id="autocompleter_country_dropoff"
                                                name="autocompleter_country_dropoff"
                                                type="search" class="form-control"
                                                placeholder="Country" required
                                                oninvalid="this.setCustomValidity('Please select a country')"/>
                                                <input type="hidden" name="dropoffCountryName" value=""
                                                id="dropoffCountryName"/>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-12" id="dropoffCityDiv">
                                            <div class="form-group">
                                                <label>City</label> <input
                                                id="autocompleter_city_dropoff"
                                                name="autocompleter_city_dropoff"
                                                type="search" class="form-control"
                                                placeholder="City"
                                                disabled="disabled" required
                                                oninvalid="this.setCustomValidity('Please select a City')"/>
                                                <input type="hidden" name="dropoffCityName" value=""
                                                id="dropoffCityName"/>
                                            </div>

                                                        <!-- required
                                                        oninvalid="this.setCustomValidity('Please select a city')" -->
                                                    </div>

                                                    <div class="col-md-6 col-sm-12" id="dropoffAccommodationDiv">
                                                        <div class="form-group">
                                                            <label>Accommodation</label> <input
                                                            id="autocompleter_accommodation_dropoff"
                                                            name="autocompleter_accommodation_dropoff"
                                                            type="search" class="form-control"
                                                            placeholder="Accommodation"
                                                            disabled="disabled" required
                                                            oninvalid="this.setCustomValidity('Please select an Accommodation')"/>
                                                            <input type="hidden" name="dropoffHotelName" value=""
                                                            id="dropoffHotelName"/>
                                                        </div>
                                                        <!-- required
                                                        oninvalid="this.setCustomValidity('Please select a accommodation')" -->
                                                    </div>


                                                    <div class="col-md-6 col-sm-12" id="dropoffTerminalDiv"
                                                    style="display: none;">
                                                    <div class="form-group">
                                                        <label>Terminal</label> <input
                                                        id="autocompleter_terminal_dropoff"
                                                        name="autocompleter_terminal_dropoff"
                                                        type="search" class="form-control"
                                                        placeholder="Terminal"
                                                        disabled="disabled" required
                                                        oninvalid="this.setCustomValidity('Please select an Terminal')"/>
                                                        <input type="hidden" name="dropoffTerminalName" value=""
                                                        id="dropoffTerminalName"/>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button id="dropoffSearchLocation" class="btn btn-primary btn-submit btn-sm"
                                            name="dropoffSearchLocation"
                                            type="button">
                                            Update
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Drop Destination pop up modal :: end -->
                    </form>
                </div>
                <!-- TRANSFER PANEL :: ENDS -->
            <?php endif; ?>

            <?php if ($data['activities']['status']): ?>
                <!-- ACTIVITIES PANEL -->
                <div class="tab-pane" id="activities">
                    <form id="searchboxform_activity" name="searchboxform_activity"
                    action="<?= $data['general']['ota_url'] ?>/reservation/activitysearchresult!callmdb.html"
                    data-toggle="validator" accept-charset="utf-8" method="post">


                    <input type="hidden" name="changedfiled" value="" id="changedfiled"/>
                    <input type="hidden" name="showcity" value="true" id="showcity"/>
                    <input type="hidden" name="reqcurrency" value="USD" id="activity_reqcurrency"/>
                    <input type="hidden" name="activityCityName" value="" id="activityCityName"/>
                    <input type="hidden" name="activityCityId" value="0" id="activityCityId"/>
                    <input type="hidden" name="activityDatefrom" value="" id="activityDatefrom"/>
                    <input type="hidden" name="activityDateto" value="" id="activityDateto"/>
                    <input type="hidden" name="activityTotalAdults" value="1" id="activityTotalAdults"/>
                    <input type="hidden" name="activityTotalChildren" value="0" id="activityTotalChildren"/>

                    <div id="search_box_main_wrap">
                        <div class="row">

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 destination modal-adjust">
                                <div class="form-group">
                                    <label><?= $data['activities']['destination_label']; ?></label>
                                    <input id="autocompleter_city_a" name="autocompleter_city_a"
                                    type="search" class="form-control" results="0"
                                    placeholder="<?= $data['activities']['destination_phold']; ?>"/>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-6 col-xs-6 modal-adjust">

                                <label>Adult(s)</label>
                                <div class="dropdown form-group" id="adultsDrpdwn_activity">
                                    <button class="btn btn-default dropdown-toggle btn-block" type="button"
                                    id="adultsDrpdwnBtn_activity" data-toggle="dropdown">
                                    1 &nbsp;Adult &nbsp;
                                    <span class="glyphicon glyphicon-chevron-down"></span>
                                </button>
                                <ul class="dropdown-menu scrollable-menu" role="menu"
                                aria-labelledby="adultsDrpdwn_activity"
                                id="adultsDrpdwnUl_activity">

                                <?php for ($i = 1; $i <= $data['activities']['adult_count']; $i++): ?>
                                    <li role="presentation">
                                        <a role="menuitem" tabindex="-1" href="javascript:void(0);"
                                        data-value="<?= $i ?>">
                                        <?= $i ?>
                                    </a>
                                </li>
                            <?php endfor; ?>

                        </ul>
                        <input type="hidden" name="adults" value="2" id="adults"/>
                    </div>
                </div>


                <div class="col-md-3 col-xs-6 col-sm-6 modal-adjust">

                    <label>Children</label>
                    <div class="dropdown form-group" id="childrenDrpdwn_activity">
                        <button class="btn btn-default dropdown-toggle btn-block" type="button"
                        id="childrenDrpdwnBtn_activity" data-toggle="dropdown">
                        0 &nbsp;Child &nbsp;
                        <span class="glyphicon glyphicon-chevron-down"></span>
                    </button>
                    <ul class="dropdown-menu scrollable-menu" role="menu"
                    aria-labelledby="childrenDrpdwn_activity"
                    id="childrenDrpdwnUl_activity">
                    <?php for ($i = 0; $i <= $data['activities']['child_count']; $i++): ?>
                        <li role="presentation">
                            <a role="menuitem" tabindex="-1" href="javascript:void(0);"
                            data-value="<?= $i ?>">
                            <?= $i ?>
                        </a>
                    </li>
                <?php endfor; ?>


            </ul>
            <input type="hidden" name="children" value="0" id="children"/>
        </div>

    </div>
    <div id="act-ages" style="display: none;"
    class="col-md-12 col-xs-12 col-sm-6 modal-adjust">
    <label>Age of Children</label>

    <div class="form-group">
        <?php for ($i = 1; $i <= $data['activities']['child_count']; $i++): ?>
            <div class="dropdown col-md-3 col-xs-4"
            id="agesDrpdwn_activity_<?= $i ?>" style="display: none;">
            <button class="btn btn-default dropdown-toggle btn-block"
            type="button" id="agesDrpdwnBtn_activity"
            data-toggle="dropdown">
            1
            <span class="glyphicon glyphicon-chevron-down"></span>
        </button>
        <ul class="dropdown-menu scrollable-menu" role="menu"
        aria-labelledby="agesDrpdwn_activity"
        id="agesDrpdwnUl_activity">

        <?php for ($j = 1; $j <= $data['activities']['child_age']; $j++): ?>
            <li role="presentation">
                <a role="menuitem" tabindex="-1"
                href="javascript:void(0);"
                data-value="<?= $j ?>">
                <?= $j ?>
            </a>
        </li>
    <?php endfor; ?>


</ul>
<input type="hidden" name="activityChildaAge" value="1"
id="activityChildaAge" disabled="disabled"/>
</div>

<?php endfor; ?>

</div>
</div>
</div>
<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 from-date modal-adjust">
        <div class="form-group ">
            <label><?= $data['activities']['from_date_label'] ?></label>
            <div class="input-group date activity_from_date">
                <input id="tmp_activity_from_date" name="tmp_activity_from_date"
                type="text" class="form-control" required readonly/>
                <span class="input-group-addon"><i
                    class="glyphicon glyphicon-calendar"></i></span>
                </div>
            </div>
        </div>

        <div id="returnDateDiv"
        class="col-lg-4 col-md-4 col-sm-6 col-xs-6 modal-adjust">
        <div class="form-group">
            <label><?= $data['activities']['to_date_label'] ?></label>
            <div class="input-group date activity_return_date">
                <input id="tmp_activity_to_date" name="tmp_activity_to_date"
                type="text" class="form-control" required readonly/>
                <span class="input-group-addon"><i
                    class="glyphicon glyphicon-calendar"></i></span>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 modal-adjust">

            <div class="form-group searchboxbuttondiv">
                <label>&nbsp;</label>
                <button class="btn btn btn-block btn-submit" type="submit">
                    search
                </button>
            </div>
        </div>
    </div>
</div>
</form>
</div>
<!-- ENDS PANEL -->
<?php endif; ?>

<?php if ($data['car_rental']['status']): ?>
    <!-- CAR RENT PANEL-->
    <div class="tab-pane" id="car-rent">
        <form id="searchboxform_car" name="searchboxform_car"
        action="<?= $data['general']['ota_url'] ?>/reservation/carsearchresult!callmdb.html"
        data-toggle="validator"
        accept-charset="utf-8">

        <input type="hidden" name="reqcurrency" value="USD" id="car_reqcurrency"/>
        <input type="hidden" name="transferOptionType" value="ROUND_TRIP"
        id="transferOptionType"/>

        <input type="hidden" name="carPickLocationCode" value="" id="carPickLocationCode"/>
        <input type="hidden" name="carPickLocationTxt" value="" id="carPickLocationTxt"/>

        <input type="hidden" name="carReturnLocationCode" value="" id="carReturnLocationCode"/>
        <input type="hidden" name="carReturnLocationTxt" value="" id="carReturnLocationTxt"/>

        <input type="hidden" name="pickupDate" value="" id="pickupDate"/>
        <input type="hidden" name="carPickDateOriginal" value="" id="carPickDateOriginal"/>

        <input type="hidden" name="carReturnDate" value="" id="carReturnDate"/>
        <input type="hidden" name="carReturnDateOriginal" value="" id="carReturnDateOriginal"/>

        <input type="hidden" name="carPickLocationId" value="" id="carPickLocationId"/>
        <input type="hidden" name="carPickcityCode" value="" id="carPickcityCode"/>
        <input type="hidden" name="carReturnLocationId" value="" id="carReturnLocationId"/>
        <input type="hidden" name="carReturnCityCode" value="" id="carReturnCityCode"/>


        <div id="search_box_cr_wrap">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="checkbox">
                        <label>
                            <div id="cr-returnToSame">
                                <div id="wwctrl_returnToSame" class="wwctrl">
                                    <input type="checkbox" name="returnToSame" value="true"
                                    id="returnToSame" class=""/>
                                    <input type="hidden" id="__checkbox_returnToSame"
                                    name="__checkbox_returnToSame"
                                    value="true"/></div>
                                </div>
                                <?= $data['car_rental']['ret_same_loc_title']; ?>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- PICKUP ROW -->
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 form-group">
                        <label><?= $data['car_rental']['ret_pickup_type_title']; ?></label>
                        <div class="dropdown full-width">
                            <button class="btn btn-default dropdown-toggle full-width" type="button"
                            id="carPickupTypeBtn" data-toggle="dropdown">
                            Airport &nbsp; <span
                            class="glyphicon glyphicon-chevron-down"></span>
                        </button>
                        <ul class="dropdown-menu scrollable-menu" role="menu"
                        aria-labelledby="carPickupTypeBtn"
                        id="carPickupTypeBtnUl">
                        <li role="presentation"><a role="menuitem" tabindex="-1"
                         data-value="TERMINAL">
                         Airport</a></li>
                         <li role="presentation"><a role="menuitem" tabindex="-1"
                             data-value="DOWNTOWN">
                             Downtown</a></li>
                         </ul>
                         <input type="hidden" name="carPickLocationType" value="TERMINAL"
                         id="carPickLocationType"/>
                     </div>
                 </div>

                 <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label><?= $data['car_rental']['ret_pickup_title']; ?> <img id="img_load_p"
                        style="display: none;"
                        src="<?= $loader_gif; ?>"/>
                    </label>

                    <input id="autocompleter_car_pickup" name="autocompleter_car_pickup"
                    type="search"
                    class="form-control"
                    placeholder="<?= $data['car_rental']['ret_pickup_pholder']; ?>">
                </div>

                <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-6">
                    <label><?= $data['car_rental']['ret_pickup_date_title']; ?></label>
                    <div class="input-group date pickup_date">
                        <input id="tmp_date_pickup_date" name="tmp_date_pickup_date" type="text"
                        class="form-control" required readonly/>
                        <span class="input-group-addon"><i
                            class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                    </div>

                    <div id="crReturnDateDiv"
                    class="col-lg-3 col-md-3 col-sm-6 col-xs-6 modal-adjust">
                    <div class="form-group">
                        <label><?= $data['car_rental']['ret_return_date_title']; ?></label>
                        <div class="input-group date return_date">
                            <input id="tmp_date_return_date" name="tmp_date_return_date"
                            type="text"
                            class="form-control" required readonly/>
                            <span class="input-group-addon"><i
                                class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- PICKUP ROW :: ENDS -->

                <!-- DROP ROW -->
                <div class="row">
                    <!-- PICKUP TIME -->
                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label id="pickupTimeBtn_hhlbl" class="control-label"
                        for="pickupTimeBtn_hh">
                        <?= $data['car_rental']['ret_pickup_time_title']; ?>
                    </label>
                    <div class="input-group">
                        <div class="dropdown date" id="pickupTime_hh">
                            <button class="btn btn-default dropdown-toggle btn-block"
                            type="button"
                            id="pickupTimeBtn_hh" name="pickupTimeBtn_hh"
                            data-toggle="dropdown">
                            09 hh &nbsp;
                            <span class="glyphicon glyphicon-chevron-down"></span>
                        </button>
                        <ul class="dropdown-menu scrollable-menu" role="menu"
                        aria-labelledby="pickupTimeBtn_hh"
                        id="pickupTimeUl_hh">
                        <?php for ($i = 0; $i <= 23; $i++): ?>
                            <li role="presentation"><a role="menuitem" tabindex="-1"
                             href="javascript:void(0);"
                             data-value="<?= sprintf("%02d", $i); ?>"> <?= sprintf("%02d", $i); ?> </a>
                         </li>
                     <?php endfor; ?>

                 </ul>
                 <input type="hidden" name="pickuphh" value="09" id="pickuphh"/>
             </div>
             <div class="dropdown date" id="pickupTime_mm">
                <button class="btn btn-default dropdown-toggle btn-block"
                type="button"
                id="pickupTimeBtn_mm" data-toggle="dropdown" value="00">
                00 mm &nbsp;
                <span class="glyphicon glyphicon-chevron-down"></span>
            </button>
            <ul class="dropdown-menu scrollable-menu" role="menu"
            aria-labelledby="pickupTimeBtn_mm"
            id="pickupTimeUl_mm">

            <li role="presentation"><a role="menuitem" tabindex="-1"
             href="javascript:void(0);"
             data-value="00">
             00 </a></li>

             <li role="presentation"><a role="menuitem" tabindex="-1"
                 href="javascript:void(0);"
                 data-value="15">
                 15 </a></li>

                 <li role="presentation"><a role="menuitem" tabindex="-1"
                     href="javascript:void(0);"
                     data-value="30">
                     30 </a></li>

                     <li role="presentation"><a role="menuitem" tabindex="-1"
                         href="javascript:void(0);"
                         data-value="45">
                         45 </a></li>

                     </ul>
                     <input type="hidden" name="pickupmm" value="00" id="pickupmm"/>
                 </div>
             </div>
         </div>
         <!-- PICKUP TIME :: ENDS -->

         <!-- DROP TIME -->
         <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12"
         id="crReturnDestTimeDiv">
         <label class="control-label"><?= $data['car_rental']['ret_return_time_title']; ?></label>
         <div class="input-group">
            <div class="dropdown date" id="returndestTime_hh">
                <button class="btn btn-default btn-block dropdown-toggle btn-block"
                type="button"
                id="returndestTimeBtn_hh" data-toggle="dropdown">
                09 hh &nbsp;
                <span class="glyphicon glyphicon-chevron-down"></span>
            </button>
            <ul class="dropdown-menu scrollable-menu" role="menu"
            aria-labelledby="returndestTimeBtn_hh"
            id="returndestTimeUl_hh">

            <?php for ($i = 0; $i <= 23; $i++): ?>
                <li role="presentation"><a role="menuitem" tabindex="-1"
                 href="javascript:void(0);"
                 data-value="<?= sprintf("%02d", $i); ?>"> <?= sprintf("%02d", $i); ?> </a>
             </li>
         <?php endfor; ?>

     </ul>
     <input type="hidden" name="returnDesthh" value="09"
     id="returnDesthh"/>
 </div>
 <div class="dropdown date" id="returndestTime_mm">
    <button class="btn btn-default dropdown-toggle btn-block"
    type="button"
    id="returndestTimeBtn_mm" data-toggle="dropdown" value="00">
    00 mm &nbsp;
    <span class="glyphicon glyphicon-chevron-down"></span>
</button>
<ul class="dropdown-menu scrollable-menu" role="menu"
aria-labelledby="returndestTimeBtn_mm"
id="returndestTimeUl_mm">

<li role="presentation"><a role="menuitem" tabindex="-1"
 href="javascript:void(0);"
 data-value="00">
 00 </a></li>

 <li role="presentation"><a role="menuitem" tabindex="-1"
     href="javascript:void(0);"
     data-value="15">
     15 </a></li>

     <li role="presentation"><a role="menuitem" tabindex="-1"
         href="javascript:void(0);"
         data-value="30">
         30 </a></li>

         <li role="presentation"><a role="menuitem" tabindex="-1"
             href="javascript:void(0);"
             data-value="45">
             45 </a></li>

         </ul>
         <input type="hidden" name="returnDestmm" value="00"
         id="returnDestmm"/>
     </div>
 </div>
</div>
<!-- DROP TIME :: ENDS -->

<!-- DRIVERS AGE -->
<div class="form-group col-md-4 col-sm-6 col-xs-12">
    <label><?= $data['car_rental']['ret_driver_age_title']; ?></label>
    <div class="dropdown form-group" id="adultsDrpdwn_transfer">
        <input id="driverAge" name="driverAge" value="" type="number"
        class="form-control" autocomplete="off" min="21" max="90"
        value="21">
    </div>
</div>
<!-- DRIVERS AGE :: ENDS -->

</div>

<div class="row">
    <!-- RETURN TYPE TITLE -->
    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12"
    id="car_returntype_div">
    <label><?= $data['car_rental']['ret_return_type_title']; ?></label>
    <div class="dropdown full-width">
        <button class="btn btn-default dropdown-toggle full-width" type="button"
        id="carReturnTypeBtn" data-toggle="dropdown">
        Airport &nbsp; <span
        class="glyphicon glyphicon-chevron-down"></span>
    </button>
    <ul class="dropdown-menu scrollable-menu" role="menu"
    aria-labelledby="carReturnTypeBtn"
    id="carReturnTypeBtnUl">
    <li role="presentation"><a role="menuitem" tabindex="-1"
     data-value="TERMINAL">
     Airport</a></li>
     <li role="presentation"><a role="menuitem" tabindex="-1"
         data-value="DOWNTOWN">
         Downtown</a></li>
     </ul>
     <input type="hidden" name="carReturnLocationType" value="TERMINAL"
     id="carReturnLocationType"/>
 </div>
</div>
<!-- RETURN TYPE TITLE :: ENDS -->

<!-- RETURN LOCATION -->
<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 modal-adjust"
id="autocompleter_car_return_div">
<label><?= $data['car_rental']['ret_return_title']; ?>
    <img id="img_load_r" style="display: none;"
    src="<?= $loader_gif; ?>"/></label>
    <div class="form-group ">
        <input id="autocompleter_car_return" name="autocompleter_car_return"
        type="search"
        placeholder="<?= $data['car_rental']['ret_return_pholder']; ?>"
        class="form-control">
    </div>
</div>
<!-- RETURN LOCATION :: ENDS -->

<div class="col-md-4 col-sm-12 col-xs-12 modal-adjust">
    <div class="form-group searchboxbuttondiv">
        <label>&nbsp;</label>
        <button class="btn btn-submit car-btn" type="submit">
            search
        </button>
    </div>
</div>

</div>
<!-- DROP ROW :: ENDS -->
</div>
<!-- Downtown destination pop up modal -->
<div id="downtownDestinationDiv"
class="searchpopupwrap modal fade bs-example-modal-lg" tabindex="-1"
role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content" style="background: #ffffff;">
        <div class="modal-header roomalocatepopuphead"
        id="pickupDestinationHeaderDiv">
        <button type="button" class="close" data-dismiss="modal"
        aria-label="Close"><span
        aria-hidden="true">&times;</span></button>
        <h5 class="modal-title"></h5>

    </div>

    <div id="" class="modal-body">
        <div class="row">

            <div id="downtown_locations_div" style="padding-left: 20px"></div>

            <div class="modal-footer">
                <button id="carPickupSearchLocation"
                class="btn btn-searchbox btn-sm btn-primary"
                name="carPickupSearchLocation" type="button">
                Update
            </button>
        </div>

    </div>
</div>

</div>
</div>
</div>
<!-- Downtown destination pop up modal :: END -->

</form>

</div>
<!-- CAR RENT PANEL :: ENDS -->
<?php endif; ?>

<?php if ($data['flights']['status']): ?>
    <!-- FLIGHTS PANEL -->
    <div class="tab-pane" id="flights">
        <div class="searchbox_main_wrapdark"></div>
        <form id="searchboxform_flight" target="_top" name="searchboxform_flight"
        action="<?= $data['general']['ota_url'] ?>/reservation/flightsearchresult!callmdb.html"
        data-toggle="validator"
        accept-charset="utf-8">
        <input type="hidden" name="reqcurrency" value="USD" id="reqcurrency"/>
        <input type="hidden" name="departAirportCode" value="" id="departAirportCode"/>
        <input type="hidden" name="arrivalAirportCode" value="" id="arrivalAirportCode"/>
        <input type="hidden" name="departAirportText" value="" id="departAirportText"/>
        <input type="hidden" name="arrivalAirportText" value="" id="arrivalAirportText"/>
        <input type="hidden" name="departureDate" value="" id="departureDate"/>
        <input type="hidden" name="returnDate" value="" id="returnDate"/>
        <input type="hidden" name="tripType" value="RETURN" id="tripType"/>
        <input type="hidden" name="cabinPref" value="M" id="cabinPref"/>

        <input type="hidden" name="departureDateOriginal" value="" id="departureDateOriginal"/>
        <input type="hidden" name="returnDateOriginal" value="" id="returnDateOriginal"/>

        <div class="row">

            <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <label><?= $data['flights']['fl_from_title'] ?></label>
                <input id="autocompleter_from" name="autocompleter_from" type="search"
                class="form-control"
                placeholder="<?= $data['flights']['fl_from_pholder'] ?>"/>
            </div>

            <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <label><?= $data['flights']['fl_to_title'] ?></label>
                <input id="autocompleter_to" name="autocompleter_to" type="search"
                class="form-control"
                placeholder="<?= $data['flights']['fl_to_pholder'] ?>"/>
            </div>

            <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                <label><?= $data['flights']['fl_depature_title'] ?></label>
                <div class="input-group date depart_date">
                    <input placeholder="Departure" id="tmp_date_depart_date"
                    name="tmp_date_depart_date" type="text"
                    class="form-control" required readonly/>
                    <span class="input-group-addon"><i class="fa fa-calendar fa-2"
                     aria-hidden="true"></i></span>
                 </div>
             </div>

             <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-6">
                <label><?= $data['flights']['fl_arrival_title'] ?></label>
                <div class="input-group form-group date arrival_date" id="div_return_date">
                    <input placeholder="Arrival" id="tmp_date_return_date"
                    name="tmp_date_return_date" type="text"
                    class="form-control" required readonly/>
                    <span class="input-group-addon"><i class="fa fa-calendar fa-2"
                     aria-hidden="true"></i></span>
                 </div>
             </div>

         </div>

         <div class="row">
            <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                <label><?= $data['flights']['fl_passangers_title'] ?></label>
                <div class="input-group">
                    <div class="dropdown full-width">
                        <button class="btn btn-default dropdown-toggle" type="button"
                        id="passengerDrpdwn"
                        data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="true">
                        <span class="glyphicon glyphicon-user"></span>
                        <span id="ctt">1 Passenger</span>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="passengerDrpdwn"
                    id="passengerDrpdwnUl">
                    <li role="presentation form-group" class="adtpasseng"><label>Adults
                        (12 and Above)</label><a
                        class="minus"><span
                        class="glyphicon glyphicon-minus-sign"></span></a><input
                        name="noOfAdults" id="noOfAdults" type='text' readonly
                        value='1'><a
                        class="plus"><span
                        class="glyphicon glyphicon-plus-sign"></span></a>
                    </li>
                    <li role="presentation form-group" class="childpasseng"><label>Children
                        (2-12 yrs)</label><a
                        class="minus"><span
                        class="glyphicon glyphicon-minus-sign"></span></a><input
                        name="noOfChildren" id="noOfChildren" type='text'
                        readonly value='0'><a
                        class="plus"><span
                        class="glyphicon glyphicon-plus-sign"></span></a>
                    </li>
                    <li role="presentation form-group" class="infapasseng"><label>Infants
                        (0-2 yrs)</label><a
                        class="minus"><span
                        class="glyphicon glyphicon-minus-sign"></span></a><input
                        name="noOfInfants" id="noOfInfants" type='text' readonly
                        value='0'><a
                        class="plus"><span
                        class="glyphicon glyphicon-plus-sign"></span></a>
                    </li>
                    <li role="separator" class="divider"></li>
                    <li role="presentation form-group" class="closeme">
                        <a><span>Close</span></a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <label><?= $data['flights']['fl_ticket_type_title'] ?></label>
            <div class="input-group">
                <div class="dropdown full-width">
                    <button class="btn btn-default dropdown-toggle transparent-filters"
                    type="button"
                    id="cabinTypeDrpdwn" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="true" value="M">
                    <span class="glyphicon glyphicon-chevron-down pull-right"></span>
                    <span id="ctt" class="pull-left">Economy Class</span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="cabinTypeDrpdwn"
                id="cabinTypeDrpdwnUl">
                <li><a id="clickid_M" tabindex="-1" data-value="M">Economy Class</a>
                </li>
                <!--  <li><a id="clickid_W" tabindex="-1" data-value="W">Premium Economy</a></li> -->
                <li><a id="clickid_C" tabindex="-1" data-value="C">Business
                    Class</a></li>
                    <li><a id="clickid_F" tabindex="-1" data-value="F">First Class</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <label><?= $data['flights']['fl_trip_type_title'] ?></label>
        <div class="input-group">
            <div class="dropdown full-width">
                <button class="btn btn-default dropdown-toggle transparent-filters text-left"
                type="button"
                id="tripTypeDrpdwn" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="true"
                value="RETURN">

                <span class="glyphicon glyphicon-chevron-down pull-right"></span>
                <span id="ctt" class="pull-left">Return Trip</span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="tripTypeDrpdwn"
            id="tripTypeDrpdwnUl">
            <li><a id="rtlinkId" tabindex="-1" data-value="RETURN"><span
                class="glyphicon glyphicon-refresh"></span> Return
                Trip</a></li>
                <li><a id="owylinkId" tabindex="-1" data-value="ONE_WAY"><span
                    class="glyphicon glyphicon-arrow-right"></span>
                    One-way Trip </a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="form-group col-md-3 col-sm-12 col-xs-12">
        <label class="hidden-xs">&nbsp;</label>
        <button class="btn btn-submit" type="submit">
            search
        </button>
    </div>
</div>

<div id="alert-danger" style="display: none;" class="alert alert-danger">
    <button data-dismiss="alert" href="javascript:void(0)" class="btn-close">x</button>
    <strong>
        <div id="div-alert-error"></div>
    </strong>
</div>

</form>

</div>
<!-- FLIGHTS PANEL :: ENDS-->
<?php endif; ?>
</div>
<?php else: ?>
    <h4 class="text-center text-danger">Widget is disabled.</h4>
<?php endif; ?>

<?php if ($is_one == false): ?>
    <h4 class="text-center text-danger">Widget is disabled.</h4>
<?php endif; ?>
</div>
</div>
</div>

<!-- MODALS -->




<!-- MODALS :: END-->

<style type="text/css">
    .widget-box {
        width: <?= $data['general']['widget_width']; ?>%;
        /*border:


    <?= $data['general']['widget_border']; ?>   px solid


    <?= $data['general']['widget_border_color']; ?>   ;*/
    border-radius: <?= $data['general']['widget_border_radius']; ?>px;
    <?php if($data['general']['widget_align'] == 'center'): ?> margin: 2% auto;
<?php endif; ?>
}

.widget-box .nav-pills > li.active > a,
.widget-box .nav-pills > li.active > a:hover,
.widget-box .nav-pills > li.active > a:hover,
.widget-box .nav-pills > li.active > a:focus {
    color: <?= $data['general']['wid_font_color']; ?>;
    background-color: <?= $data['general']['wid_bg_color']; ?>;
}

.widget-box .nav-pills > li > a {
    color: <?= $data['general']['wid_font_color']; ?>;
    border-radius: <?= $data['general']['widget_border_radius']; ?>px;
}

.widget-box .nav-pills > li > a:hover,
.widget-box .nav-pills > li > a:hover,
.widget-box .nav-pills > li > a:focus {
    background-color: <?= $data['general']['btn_bg_color']; ?>;
    color: <?= $data['general']['btn_font_color']; ?>;
    opacity: 1;
}

.widget-box .tab-content .active {
    background-color: <?= $data['general']['wid_bg_color']; ?>;
    border-bottom-left-radius: <?= $data['general']['widget_border_radius']; ?>px;
    border-bottom-right-radius: <?= $data['general']['widget_border_radius']; ?>px;

}

.widget-box .tab-content .active label {
    color: <?= $data['general']['wid_font_color']; ?>;
}

.widget-box .form-control,
.widget-box .btn,
.widget-box .input-group-addon:last-child {

}

.widget-box .form-control,
.widget-box .dropdown > button {
    background-color: <?= $data['general']['widget_inpt_bg_color']; ?> !important;
    color: <?= $data['general']['widget_inpt_fnt_color']; ?> !important;
    border-radius: <?= $data['general']['widget_inpt_border_radius']; ?>px !important;
    border: 1px solid;
}

.widget-box .btn {
    border-radius: <?= $data['general']['widget_btn_border_radius']; ?>px !important;
}

.widget-box .nav-pills > li:first-child > a {
    border-top-left-radius: <?= $data['general']['widget_border_radius']; ?>px;
}

.widget-box .nav-pills > li.active > a {
    border-top-left-radius: <?= $data['general']['widget_border_radius']; ?>px;
    border-top-right-radius: <?= $data['general']['widget_border_radius']; ?>px;
    border: <?= $data['general']['widget_border']; ?>px solid <?= $data['general']['widget_border_color']; ?>;
    border-bottom: 0px none;
    opacity: 1 !important;
}

.widget-box .nav-pills > li > a {
    background-color: <?= $data['general']['wid_bg_color']; ?>;
    border-top-left-radius: <?= $data['general']['widget_border_radius']; ?>px !important;
    border-top-right-radius: <?= $data['general']['widget_border_radius']; ?>px !important;
}

.tab-content .active {
    border: <?= $data['general']['widget_border']; ?>px solid <?= $data['general']['widget_border_color']; ?>;
}

.widget-box .btn-submit,
.widget-box .btn-submit:hover,
.widget-box .btn-submit:focus {
    background-color: <?= $data['general']['btn_bg_color']; ?>;
    color: <?= $data['general']['btn_font_color']; ?>;
    border-radius: <?= $data['general']['widget_btn_border_radius']; ?>px !important;
}

.widget-box .btn-submit:hover,
.widget-box .btn-submit:focus {
    box-shadow: 0px 0px 5px -1px <?= $data['general']['btn_bg_color']; ?>;
}

#passengerDrpdwnUl > li > input {
    background-color: <?= $data['general']['btn_bg_color']; ?>;
    color: <?= $data['general']['btn_font_color']; ?>;
}

.datepicker.dropdown-menu {
    background-color: <?= $data['general']['widget_clndr_bg_color']; ?> !important;
    color: <?= $data['general']['widget_clndr_fnt_color']; ?> !important;
}

.form-control::-webkit-input-placeholder { /* Chrome/Opera/Safari */
    color: #999 !important;;
}

.form-control::-moz-placeholder { /* Firefox 19+ */
    color: #999 !important;;
}

.form-control:-ms-input-placeholder { /* IE 10+ */
    color: #999 !important;;
}

.form-control:-moz-placeholder { /* Firefox 18- */
    color: #999 !important;;
}

.widget-box .btn-submit, .widget-box .btn-submit:focus, .widget-box .btn-submit:active {
    background-color: <?= $data['general']['btn_bg_color']; ?>;
    color: <?= $data['general']['btn_font_color']; ?>;
    <?php if($data['general']['widget_border'] != ''): ?> border: 1px solid <?= $data['general']['widget_border_color']; ?> !important;
<?php endif; ?>
}

/** CUSTOM STYLES */
<?= $data['general']['custom_styles']; ?>
</style>

<script type="text/javascript">
    var agent_url = '<?= $data['general']['ota_url']; ?>';
</script>
