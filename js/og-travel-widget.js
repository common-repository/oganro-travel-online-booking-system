var jqueryDateFormat = "yy-mm-dd";
var COMMON_ERR_MSG_SERVER_ERROR = "Error occured while retrieving data";
var COMMON_MSG_NO_RECORDS = "No records available for the search criteria";
jQuery(document).ready(function ($) {
    $(".btn-close").click(function (e) {
        e.preventDefault();
        $(this).parent().hide();
    });
});

var cache = {};
var dropDownIconStyle = '<span class="glyphicon glyphicon-chevron-down"></span>';

/** HOTEL SCRIPTS */
jQuery(function ($) {

    var nighttxt = 'Night';
    var nightstext = 'Nights';

    var defaultNights = 2;

    initNightsDropDown = function (nights) {
        $("#noofnights").val(nights);
        $("#nightsDrpdwnBtn").val(nights);


        if (nights == 1 ? true : false) {
            $("#nightsDrpdwnBtn").html(nights + ' ' + nighttxt + ' ' + dropDownIconStyle);
        } else {
            $("#nightsDrpdwnBtn").html(nights + ' ' + nightstext + ' ' + dropDownIconStyle);
        }
    };

    initNightsDropDown(defaultNights);


    var hotel_adjustToDate = function (nights) {
        var fromDate = $(".input-group.date.from_date").datepicker('getDate');
        if (!isNaN(fromDate)) {
            $("#noofnights").val(nights);

            var endDate = fromDate;
            var minDateObj = new Date(endDate);
            var minDate = new Date(minDateObj.getFullYear(), minDateObj.getMonth(), minDateObj.getDate() + 1);
            endDate.setDate(endDate.getDate() + Number(nights));

            jQuery(".input-group.date.to_date").datepicker('setStartDate', minDate);
            jQuery('.input-group.date.to_date').datepicker('setDate', endDate);
        }
    };

    $("#nightsDrpdwnUl li a").click(function () {
        var nights = $(this).data('value');
        hotel_adjustToDate(nights);
    });

    $.fn.datepicker.defaults = {
        allowDeselection: false,
    };

    $('.input-group.date.from_date').datepicker({
        language: 'en',
        format: "dd-M-yyyy",
        startDate: "0d",
        forceParse: 'false',
        startView: 0,
        minViewMode: 0,
        todayBtn: false,
        autoclose: true,
        todayHighlight: true
    }).on('changeDate', function (ev) {
        hotel_adjustToDate($("#noofnights").val());
        $('.to_date').find('span.input-group-addon').click();
    });

    $('.input-group.date.to_date').datepicker({
        language: 'en',
        format: "dd-M-yyyy",
        startDate: "+1",
        forceParse: 'false',
        startView: 0,
        minViewMode: 0,
        autoclose: true,
        todayHighlight: true
    }).on('changeDate', function (ev) {
        var toDate = $(".input-group.date.to_date").datepicker('getDate');
        if (!isNaN(toDate)) {
            var checkIn = $(".input-group.date.from_date").datepicker('getDate');
            var checkOut = $(".input-group.date.to_date").datepicker('getDate');
            var oneDay = 1000 * 60 * 60 * 24;
            var dateDifferent = Math.ceil((checkOut - checkIn) / oneDay);
            if (dateDifferent >= 1 && dateDifferent <= 30) {
                initNightsDropDown(dateDifferent);
            } else if (dateDifferent < 1) {
                // console.log('dateDifferent ==>' + dateDifferent);
            } else if (dateDifferent > 30) {
                initNightsDropDown(30);
                checkOut.setDate(checkOut.getDate() - 30);
                $('.input-group.date.from_date').datepicker('setDate', checkOut);
            }
        }
    });

    var checkinDate = new Date();
    checkinDate.setDate(checkinDate.getDate() + 3);

    $(".input-group.date.from_date").datepicker("update", checkinDate);
    hotel_adjustToDate($("#noofnights").val());

    popMouseEnter = function () {

        var noOfRms = $("#noOfRoomsDrpdwnBtn").val();

        var mHtml = '';

        if (noOfRms > 0) {

            for (var rm = 1; rm <= noOfRms; rm++) {

                var adults = $("#adultsDwn_" + rm).find('.btn').val();
                var children = $("#childrenDropDwn_" + rm).find('.btn').val();

                mHtml += '<div class="popoversecdiv"><div class="popoversecdivroom"><div>Room ' + rm + '</div><div><div class="badge popadults">' + adults + '</div>' +
                '&nbsp;<span class="seacrhpopover_adults">Adults</span></div>';

                if (children > 0) {
                    mHtml += '<div class="badge popchild">' + children + '</div>&nbsp;<span>Children</span>';
                    mHtml += '&nbsp;<div><span>Age:</span>&nbsp;';
                    for (var ch = 1; ch <= children; ch++) {

                        var age = $("#ageDropDwn_" + rm + "_" + ch).find('.btn').val();
                        mHtml += '<span class="badge agebadge">' + age + '&nbsp;</span>';
                    }
                    mHtml += '';
                }
                mHtml += '</div></div>';

            }
        } else {
            if (noOfRms == -1) {
                mHtml = '<div class="popoversecdiv"><div class="popoversecdivroom"><div>Room 1:</div> ' +
                '<div><div class="badge popadults">2</div><span class="seacrhpopover_adults">Adults</span></div></div></div>';
            } else if (noOfRms == -2) {
                mHtml = '<div>Room 1: ' +
                'Adults&nbsp;<span class="badge">1</span></div>';
            }
        }
        $("#popovercontent").html(mHtml);

    };

    initOccupancy = function (noOfRooms, isToggle) {
        if (noOfRooms > 0) {
            $("#noofrooms").val(noOfRooms);
        }

        $("#adultsDwn_2, #adultsDwn_3, #adultsDwn_4, #adultsDwn_5").find('#adults').prop('disabled', true);
        $("#adultsDwn_2, #adultsDwn_3, #adultsDwn_4, #adultsDwn_5").hide();

        $("#childrenDropDwn_2, #childrenDropDwn_3, #childrenDropDwn_4, #childrenDropDwn_5").find('#children').prop('disabled', true);
        $("#childrenDropDwn_2, #childrenDropDwn_3, #childrenDropDwn_4, #childrenDropDwn_5").hide();

        $(".ageDropDwnToggle").hide();
        $(".ageLblToggle").hide();

        if (isToggle) {
            $('#rmOccupancyModal').modal('toggle');
        }

        if (noOfRooms > 0) {

            var adltArr = [];
            var childArr = [];
            var ageArr = [];
            var agcnt = 0;

            for (var rm = 1; rm <= noOfRooms; rm++) {

                $("#adultsDwn_" + rm).find('#adults').prop('disabled', false);
                $("#adultsDwn_" + rm).show();

                if (!isToggle) {
                    var adltCount = adltArr[rm - 1];
                    $("#adultsDwn_" + rm).find('.btn').val(adltCount);
                    $("#adultsDwn_" + rm).find('.btn').html(adltCount + " Adults <span class='glyphicon glyphicon-chevron-down'></span>");
                    $("#adultsDwn_" + rm).find('#adults').val(adltCount);
                }

                $("#childrenDropDwn_" + rm).find('#children').prop('disabled', false);
                $("#childrenDropDwn_" + rm).show();

                var childCount = 0;

                if (!isToggle) {
                    childCount = childArr[rm - 1];
                } else {
                    childCount = $("#childrenDropDwn_" + rm).find('.btn').val();
                }

                if (childCount > 0) {
                    if (!isToggle) {
                        $("#childrenDropDwn_" + rm).find('.btn').val(childCount);
                        $("#childrenDropDwn_" + rm).find('.btn').html(childCount + " Children <span class='glyphicon glyphicon-chevron-down'></span>");
                        $("#childrenDropDwn_" + rm).find('#children').val(childCount);
                    }

                    $("#age_lbl_" + rm).show();
                    for (var ch = 1; ch <= childCount; ch++) {
                        $("#ageDropDwn_" + rm + "_" + ch).find('#age').prop('disabled', false);
                        $("#ageDropDwn_" + rm + "_" + ch).show();

                        if (!isToggle) {
                            var age = ageArr[agcnt];
                            $("#ageDropDwn_" + rm + "_" + ch).find('.btn').val(age);
                            $("#ageDropDwn_" + rm + "_" + ch).find('.btn').html(age + " <span class='glyphicon glyphicon-chevron-down'></span>");
                            $("#ageDropDwn_" + rm + "_" + ch).find('#age').val(age);
                        }

                        agcnt++;
                    }
                }

            }

        }
    };

    $("#noOfRoomsDrpdwnUl li a").click(function () {

        var noOfRooms = $(this).data('value');

        var isToggle = false;
        if (noOfRooms > 0) {
            isToggle = true;
        } else if (noOfRooms == -1) {
            $("#noofrooms").val(1);
            $("#adultsDwn_1").find('#adults').val("2");
        } else if (noOfRooms == -2) {
            $("#noofrooms").val(1);
            $("#adultsDwn_1").find('#adults').val("1");
        }
        initOccupancy(noOfRooms, isToggle);

        $(this).parents('.dropdown').find('.btn').html($(this).text() + ' ' + dropDownIconStyle);
        $(this).parents(".dropdown").find('.btn').val(noOfRooms);

        popMouseEnter();

    });

    $('#updateRoomsBtn').click(function () {
        var btn = $(this);
        btn.button('loading');

        btn.button('reset');
        $('#rmOccupancyModal').modal('toggle');
    });

    $("#adultsDrpdwnUl li a").click(function () {
        $(this).parents('.dropdown').find('.btn').html($(this).text() + ' ' + dropDownIconStyle);
        var selctdAdults = $(this).data('value');
        $(this).parents(".dropdown").find('.btn').val(selctdAdults);
        $(this).parents(".dropdown").find('#adults').val(selctdAdults);
    });

    $("#childrenDrpdwnUl li a").click(function () {

        var arr = $(this).parents(".dropdown").prop("id").split('_');

        $(".ageRawToggle_" + arr[1]).hide();
        $("#age_lbl_" + arr[1]).hide();

        $(this).parents('.dropdown').find('.btn').html($(this).text() + ' ' + dropDownIconStyle);
        var selctdChildren = $(this).data('value');
        $(this).parents(".dropdown").find('.btn').val(selctdChildren);
        $(this).parents(".dropdown").find('#children').val(selctdChildren);


        if ($(this).data('value') > 0) {

            $("#age_lbl_" + arr[1]).show();

            for (var ch = 1; ch <= $(this).data('value'); ch++) {
                $("#ageDropDwn_" + arr[1] + "_" + ch).find('#age').prop('disabled', false);
                $("#ageDropDwn_" + arr[1] + "_" + ch).show();
            }

        }
    });

    $("#ageDrpdwnUl li a").click(function () {
        $(this).parents('.dropdown').find('.btn').html($(this).text() + ' ' + dropDownIconStyle);
        var selctdAge = $(this).data('value');
        $(this).parents(".dropdown").find('.btn').val(selctdAge);
        $(this).parents(".dropdown").find('#age').val(selctdAge);
    });


    $('#noOfRoomsDrpdwn>.triggerx').popover({
        trigger: 'hover focus',
        'placement': 'right',
        html: true,
        title: function () {
            return $(this).parent().find('.head').html();
        },
        content: function () {
            return $(this).parent().find('.content').html();
        }

    }).on('mouseenter', popMouseEnter);


    var autoCompleterUrl = agent_url + '/common/autocompleter!getLocationList.html';

    if ('' != '') {

        document.getElementById('form_reqcurrency').value = '';
    } else {

    }

    try {
        $("#autocompleter_city").autocomplete({
            source: function (request, response) {
                if (request.term in cache) {
                    response(cache[request.term]);
                    return;
                }
                $.ajax({
                    url: autoCompleterUrl,
                    type: "POST",
                    dataType: "jsonp",
                    data: {
                        featureClass: "P",
                        style: "full",
                        term: request.term
                    },
                    success: function (data) {
                        returnData = $.map(data.cityNameIdList, function (item) {
                            return {
                                label: item.myValue,
                                cityId: item.myKey
                            };
                        });
                        cache[request.term] = returnData;
                        response(returnData);
                    }
                });
            },

            delay: 200,
            minLength: 3,
            scroll: true,
            height: 200,
            select: function (event, ui) {
                $('#cityName').val(ui.item.label);
                $('#cityId').val(ui.item.cityId);
                $('.from_date').find('span.input-group-addon').click();
            },
            open: function () {
                $(this).removeClass("ui-corner-all").addClass("ui-corner-top");
            },
            close: function () {
                $(this).removeClass("ui-corner-top").addClass("ui-corner-all");
            }
        });

    } catch (ex) {
        console.error("AUTO COMPLETE ERROR:", ex);
    }

    $("#autocompleter_city").focus(function (e) {
        $(this).val("");
        $("#cityName").val("");
        $("#cityId").val(0);
    });

    $('#autocompleter_city').on('input', function (e) {
        e.target.setCustomValidity('');
    });

    setTimeout(function () {
        $("#autocompleter_city").val("");

        if ('') {
            $("#noofnights").val('');
        }


        if ('' != '') {
            $('.input-group.date.from_date').datepicker('update', '');
            $('.input-group.date.to_date').datepicker('update', '');
            hotel_adjustToDate($("#noofnights").val());
        }

        if ("" != '') {
            var roomTxt = "Rooms";
            if ("" == 1) {
                roomTxt = "Room";
            }
            $("#noOfRoomsDrpdwnBtn").html(" " + roomTxt + " <span class='glyphicon glyphicon-chevron-down pull-right'></span>");
            $("#noOfRoomsDrpdwnBtn").val("");
            initOccupancy('', false);
            popMouseEnter();
        }


        if ("0" != null && "0" != '') {

            $("#hotelMappingId").val("0");
        }

    }, 100);

    $("#searchboxform").submit(function (e) {
        var self = this;
        e.preventDefault();

        if ($('#cityId').val() == 0) {

            $("#autocompleter_city").popover({
                placement: 'bottom',
                content: 'Select City'
            }).popover('show');
            return;
        }

        var m_names = new Array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
        var fromDate = new Date($(".input-group.date.from_date").datepicker('getDate'));
        var toDate = new Date($(".input-group.date.to_date").datepicker('getDate'));

        $("#datefrom").val(fromDate.getDate() + "-" + m_names[fromDate.getMonth()] + "-" + fromDate.getFullYear());
        $("#dateto").val(toDate.getDate() + "-" + m_names[toDate.getMonth()] + "-" + toDate.getFullYear());

        if ($('#tmp_date_from').val() == '') {

            $("#tmp_date_from").popover({
                placement: 'bottom',
                content: 'Select Valid Date'
            }).popover('show');
            return;
        }

        if ($('#tmp_date_to').val() == '') {

            $("#tmp_date_to").popover({
                placement: 'bottom',
                content: 'Select Valid Date'
            }).popover('show');
            return;
        }

        self.submit();
    });


});
/** HOTEL SCRIPTS :: ENDS */

/** TRANSFER SCRIPTS */


try {
    jQuery(document).ready(function ($) {

        $("#searchboxform_transfer").validate({
            ignore: "",
            rules: {
                autocompleter_pickup: "required",
                autocompleter_dropoff: "required",
                pickuphh: "required",
                pickupmm: "required",

                returnDesthh: {
                    "required": {
                        depends: function () {
                            return ($('#transferOptionType').val() == "ROUND_TRIP");
                        }
                    }
                },
                returnDestmm: {
                    "required": {
                        depends: function () {
                            return ($('#transferOptionType').val() == "ROUND_TRIP");
                        }
                    }
                },

                pickupCountryName: "required",

                pickupCityName: {
                    "required": {
                        depends: function () {
                            return ($('#pickupLocationType').val() == "ACCOMMODATION");
                        }
                    }
                },

                pickupHotelName: {
                    "required": {
                        depends: function () {
                            return ($('#pickupLocationType').val() == "ACCOMMODATION");
                        }
                    }
                },

                pickupTerminalName: {
                    "required": {
                        depends: function () {
                            return ($('#pickupLocationType').val() == "TERMINAL");
                        }
                    }
                },

                autocompleter_city_pickup: {
                    "required": {
                        depends: function () {
                            return ($('#pickupLocationType').val() == "ACCOMMODATION");
                        }
                    }
                },

                autocompleter_accommodation_pickup: {
                    "required": {
                        depends: function () {
                            return ($('#pickupLocationType').val() == "ACCOMMODATION");
                        }
                    }
                },

                autocompleter_terminal_pickup: {
                    "required": {
                        depends: function () {
                            return ($('#pickupLocationType').val() == "TERMINAL");
                        }
                    }
                },

                dropoffCountryName: "required",

                dropoffCityName: {
                    "required": {
                        depends: function () {
                            return ($('#dropoffLocationType').val() == "ACCOMMODATION");
                        }
                    }
                },

                dropoffHotelName: {
                    "required": {
                        depends: function () {
                            return ($('#dropoffLocationType').val() == "ACCOMMODATION");
                        }
                    }
                },

                dropoffTerminalName: {
                    "required": {
                        depends: function () {
                            return ($('#dropoffLocationType').val() == "TERMINAL");
                        }
                    }
                },

                autocompleter_city_dropoff: {
                    "required": {
                        depends: function () {
                            return ($('#dropoffLocationType').val() == "ACCOMMODATION");
                        }
                    }
                },

                autocompleter_accommodation_dropoff: {
                    "required": {
                        depends: function () {
                            return ($('#dropoffLocationType').val() == "ACCOMMODATION");
                        }
                    }
                },

                autocompleter_terminal_dropoff: {
                    "required": {
                        depends: function () {
                            return ($('#dropoffLocationType').val() == "TERMINAL");
                        }
                    }
                },

            },

            messages: {
                autocompleter_pickup: "is required",
                autocompleter_dropoff: "is required",
                pickuphh: "need to select",
                pickupmm: "need to select",
                returnDesthh: "need to select",
                returnDestmm: "need to select",
                pickupCountryName: "need to select",
                pickupCityName: "need to select",
                pickupHotelName: "need to select",
                pickupTerminalName: "need to select",
                dropoffCountryName: "need to select",
                dropoffCityName: "need to select",
                dropoffHotelName: "need to select",
                dropoffTerminalName: "need to select"


            },


            // specifying a submitHandler prevents the default submit, good for the demo
            submitHandler: function () {
                //alert("submitted!");
            }


        });


});

} catch (e) {
    alert(e);
}


jQuery(document).ready(function($){


    $("#autocompleter_pickup").focus(function (e) {
        $(this).val("");
        $("#pickupLocationTxt").val("");
        $('#pickupLocationType').val("TERMINAL");
        $("#pickupLocationCode").val(0);
    });

    $('#autocompleter_pickup').on('input', function (e) {
        e.target.setCustomValidity('');
    });

    $("#autocompleter_dropoff").focus(function (e) {
        $(this).val("");
        $("#dropoffLocationTxt").val("");
        $('#dropoffLocationType').val("ACCOMMODATION");
        $("#dropoffLocationCode").val(0);
    });

    $('#autocompleter_dropoff').on('input', function (e) {
        e.target.setCustomValidity('');
    });


    $('#autocompleter_country_pickup').on('input', function (e) {
        e.target.setCustomValidity('');
    });
    $('#autocompleter_city_pickup').on('input', function (e) {
        e.target.setCustomValidity('');
    });
    $('#autocompleter_accommodation_pickup').on('input', function (e) {
        e.target.setCustomValidity('');
    });
    $('#autocompleter_terminal_pickup').on('input', function (e) {
        e.target.setCustomValidity('');
    });
    $('#autocompleter_country_dropoff').on('input', function (e) {
        e.target.setCustomValidity('');
    });
    $('#autocompleter_city_dropoff').on('input', function (e) {
        e.target.setCustomValidity('');
    });
    $('#autocompleter_accommodation_dropoff').on('input', function (e) {
        e.target.setCustomValidity('');
    });
    $('#autocompleter_terminal_dropoff').on('input', function (e) {
        e.target.setCustomValidity('');
    });


    trf_adjustToDate = function (nights) {
        var fromDate = $("#transfer .pickup_date").datepicker('getDate');

        if (!isNaN(fromDate)) {
            $("#noofnights").val(nights);

            var endDate = fromDate;
            var minDateObj = new Date(endDate);
            var minDate = new Date(minDateObj.getFullYear(), minDateObj.getMonth(), minDateObj.getDate() + 1);
            endDate.setDate(endDate.getDate() + Number(nights));

            $("#transfer .return_date").datepicker('setStartDate', minDate);
            $('#transfer .return_date').datepicker('setDate', endDate);
        }
    };


    $('#transfer .pickup_date').datepicker({
        language: 'en',
        format: "dd-M-yyyy",
        startDate: "0d",
        forceParse: 'false',
        startView: 0,
        minViewMode: 0,
        todayBtn: "linked",
        autoclose: true,
        todayHighlight: true
    }).on('changeDate', function (ev) {
        trf_adjustToDate(2);
    });

    $('#transfer .return_date').datepicker({
        language: 'en',
        format: "dd-M-yyyy",
        startDate: "+1",
        forceParse: 'false',
        startView: 0,
        minViewMode: 0,
        autoclose: true,
        todayHighlight: true
    }).on('changeDate', function (ev) {
        var toDate = $("#transfer .return_date").datepicker('getDate');
        if (!isNaN(toDate)) {
            var checkIn = $("#transfer .pickup_date").datepicker('getDate');
            var checkOut = $("#transfer .return_date").datepicker('getDate');
            var oneDay = 1000 * 60 * 60 * 24;
            var dateDifferent = Math.ceil((checkOut - checkIn) / oneDay);
            if (dateDifferent >= 1 && dateDifferent <= 30) {
            } else if (dateDifferent < 1) {
            } else if (dateDifferent > 30) {
                initNightsDropDown(30);
                checkOut.setDate(checkOut.getDate() - 30);
                $('#transfer .pickup_date').datepicker('setDate', checkOut);
            }
        }
    });


    var frmDate = new Date();
    frmDate.setDate(frmDate.getDate() + 3);
    $('#transfer .pickup_date').datepicker('setDate', frmDate).datepicker('update');


    var toDate = new Date();
    toDate.setDate(toDate.getDate() + 5);
    $('#transfer .date.return_date').datepicker('setDate', toDate).datepicker('update');


    var hhText = 'hh';
    var mmText = 'mm';

    $("#pickupTimeUl_hh li a").click(function () {
        // console.log('======' + $(this).text().trim());
        $(this).parents('.dropdown').find('.btn').html($(this).text() + ' ' + hhText + ' ' + dropDownIconStyle);
        $(this).parents(".dropdown").find('.btn').val($(this).data('value'));
        $("#pickuphh").val($(this).data('value'));
    });

    $("#pickupTimeUl_mm li a").click(function () {
        $(this).parents('.dropdown').find('.btn').html($(this).text() + ' ' + mmText + ' ' + dropDownIconStyle);
        $(this).parents(".dropdown").find('.btn').val($(this).data('value'));
        $("#pickupmm").val($(this).data('value'));
    });

    $("#dropoffTimeUl_hh li a").click(function () {
        $(this).parents('.dropdown').find('.btn').html($(this).text() + ' ' + hhText + ' ' + dropDownIconStyle);
        $(this).parents(".dropdown").find('.btn').val($(this).data('value'));
        $("#dropoffhh").val($(this).data('value'));
    });

    $("#dropoffTimeUl_mm li a").click(function () {
        $(this).parents('.dropdown').find('.btn').html($(this).text() + ' ' + mmText + ' ' + dropDownIconStyle);
        $(this).parents(".dropdown").find('.btn').val($(this).data('value'));
        $("#dropoffmm").val($(this).data('value'));
    });

    $("#returndestTimeUl_hh li a").click(function () {
        $(this).parents('.dropdown').find('.btn').html($(this).text() + ' ' + hhText + ' ' + dropDownIconStyle);
        $(this).parents(".dropdown").find('.btn').val($(this).data('value'));
        $("#returnDesthh").val($(this).data('value'));
    });

    $("#returndestTimeUl_mm li a").click(function () {
        $(this).parents('.dropdown').find('.btn').html($(this).text() + ' ' + mmText + ' ' + dropDownIconStyle);
        $(this).parents(".dropdown").find('.btn').val($(this).data('value'));
        $("#returnDestmm").val($(this).data('value'));
    });


    var adltText = 'Adults';
    $("#adultsDrpdwnUl_transfer li a").click(function () {
        $(this).parents('.dropdown').find('.btn').html($(this).text() + ' ' + adltText + ' ' + dropDownIconStyle);
        $(this).parents(".dropdown").find('.btn').val($(this).data('value'));
        $("#noOfAdults_transfer").val($(this).data('value'));
    });

    var childText = 'Children';
    $("#childrenDrpdwnUl_transfer li a").click(function () {
        $(this).parents('.dropdown').find('.btn').html($(this).text() + ' ' + childText + ' ' + dropDownIconStyle);
        $(this).parents(".dropdown").find('.btn').val($(this).data('value'));
        $("#noOfChildren_transfer").val($(this).data('value'));


        $("#agesDiv").hide();

        for (var ch = 1; ch <= 40; ch++) {
            $("#agesDrpdwn_transfer_" + ch).find('#age_transfer').prop('disabled', true);
            $("#agesDrpdwn_transfer_" + ch).hide();
        }


        if ($(this).data('value') > 0) {

            //	$("#age_lbl_"+arr[1]).show();
            $("#agesDiv").show();

            for (var ch = 1; ch <= $(this).data('value'); ch++) {
                $("#agesDrpdwn_transfer_" + ch).find('#age_transfer').prop('disabled', false);
                $("#agesDrpdwn_transfer_" + ch).css('display', 'inline-block');
            }

        }
    });


    $("#agesDrpdwnUl_transfer li a").click(function () {
        $(this).parents('.dropdown').find('.btn').html($(this).text() + ' ' + dropDownIconStyle);
        var selctdAge = $(this).data('value');
        $(this).parents(".dropdown").find('.btn').val(selctdAge);
        $(this).parents(".dropdown").find('#age_transfer').val(selctdAge);
    });


    $("#searchboxform_transfer").submit(function (e) {
        var self = this;
        e.preventDefault();
        var fromDate = new Date($("#transfer .pickup_date").datepicker('getDate'));

        var frmtedFromMonth = (fromDate.getMonth() + 1).toString();
        var frmtedFromDay = fromDate.getDate().toString();
        if (frmtedFromMonth.length == 1) frmtedFromMonth = "0" + frmtedFromMonth;
        if (frmtedFromDay.length == 1) frmtedFromDay = "0" + frmtedFromDay;

        $("#transfer #pickupDate").val(fromDate.getFullYear() + "-" + frmtedFromMonth + "-" + frmtedFromDay);
        $("#transfer #pickupDateOriginal").val($("#tmp_date_pickup_date").val());


        var toDate = new Date($("#transfer .return_date").datepicker('getDate'));

        var frmtedToMonth = (toDate.getMonth() + 1).toString();
        var frmtedToDay = toDate.getDate().toString();
        if (frmtedToMonth.length == 1) frmtedToMonth = "0" + frmtedToMonth;
        if (frmtedToDay.length == 1) frmtedToDay = "0" + frmtedToDay;

        $("#transfer #returnDate").val(toDate.getFullYear() + "-" + frmtedToMonth + "-" + frmtedToDay);
        $("#transfer #returnDateOriginal").val($("#tmp_date_return_date").val());

        if ($("#searchboxform_transfer").valid()) {
            self.submit();
        } else {
            // console.log("NOT VALIDE");
        }


    });


    setTimeout(function () {


        if ('' != '') {


            $("#transferOptionType").val("");

            if ('' == 'ROUND_TRIP') {
                $("#transferOption_R").prop("checked", true);
                $("#transferOption_O").prop("checked", false);
                $("#transferOption_R").trigger("change");
            } else if ('' == 'ONE_WAY') {
                $("#transferOption_O").prop("checked", true);
                $("#transferOption_R").prop("checked", false);
                $("#transferOption_O").trigger("change");

            }

        }

        if ('' != '') {
            $("#autocompleter_pickup").val("");
        }

        if ('' != '') {
            $("#autocompleter_dropoff").val("");
        }

        if ('' != '') {
            $("#pickupLocationType").val("");
        }

        if ('' != '') {
            $("#pickupCountryId").val("");
            $("#pickupCountryName").val("");
            $("#autocompleter_country_pickup").val("");
            $("#autocompleter_country_pickup").html("");
        }

        if ('' != '') {
            if ('' == 'ACCOMMODATION') {
                $("#pickupCityId").val("");
                $("#pickupCityName").val("");
                $("#pickupHotelId").val("");
                $("#pickupHotelName").val("");
            }

            if ('' == 'TERMINAL') {
                $("#pickupTerminalId").val("");
                $("#pickupTerminalName").val("");
            }
        }

        if ('' != '') {
            $("#dropoffLocationType").val("");
        }

        if ('' != '') {
            $("#dropoffCountryId").val("");
            $("#dropoffCountryName").val("");
            $("#autocompleter_country_dropoff").val("");
            $("#autocompleter_country_dropoff").html("");

        }

        if ('' != '') {

            if ('' == 'ACCOMMODATION') {
                $("#dropoffCityId").val("");
                $("#dropoffCityName").val("");
                $("#dropoffHotelId").val("");
                $("#dropoffHotelName").val("");
            }

            if ('' == 'TERMINAL') {
                $("#dropoffTerminalId").val("");
                $("#dropoffTerminalName").val("");
            }

        }


        if ('' != '') {
            $('#transfer .pickup_date').datepicker('setDate', '');
            $("#dropoffTerminalName").val("");
            $("#pickuphh").val("");
            $("#pickupmm").val("");
            $("#pickupTime_hh").find('.btn').val("");
            $("#pickupTime_hh").find('.btn').html("" + ' ' + hhText + ' ' + dropDownIconStyle);
            $("#pickupTime_mm").find('.btn').val("");
            $("#pickupTime_mm").find('.btn').html("" + ' ' + mmText + ' ' + dropDownIconStyle);
        }

        if ('' != '') {
            $('#transfer .return_date').datepicker('setDate', '');
            $("#returnDesthh").val("");

            $("#returnDestmm").val("");
            $("#returndestTime_hh").find('.btn').val("");
            $("#returndestTime_hh").find('.btn').html("" + ' ' + hhText + ' ' + dropDownIconStyle);
            $("#returndestTime_mm").find('.btn').val("");
            $("#returndestTime_mm").find('.btn').html("" + ' ' + mmText + ' ' + dropDownIconStyle);
        }

        if ("1" != '') {


            $("#adultsDrpdwnBtn_transfer").html("1 &nbsp;Adult  <span class='glyphicon glyphicon-chevron-down'></span>");
            $("#adultsDrpdwnBtn_transfer").val("1");
        } else {
            $("#adultsDrpdwnBtn_transfer").html("1 &nbsp;Adult  <span class='glyphicon glyphicon-chevron-down'></span>");
            $("#adultsDrpdwnBtn_transfer").val("1");
        }

        if ("0" != '' && "0" != '0') {

            $("#childrenDrpdwnBtn_transfer").html("0 &nbsp;Children  <span class='glyphicon glyphicon-chevron-down'></span>");
            $("#childrenDrpdwnBtn_transfer").val("0");


            $("#agesDiv").show();


            var childArr = ''.split(",");

            var childCnt = [0];
            for (var ch = 1; ch <= childCnt; ch++) {
                var age = childArr[ch - 1];
                $("#agesDrpdwn_transfer_" + ch).find('#age_transfer').prop('disabled', false);
                $("#agesDrpdwn_transfer_" + ch).css('display', 'inline-block');
                //$("#agesDrpdwn_transfer_"+ch).val(age);

                $("#agesDrpdwn_transfer_" + ch).find('.btn').val(age.trim());
                $("#agesDrpdwn_transfer_" + ch).find('.btn').html(age + " <span class='glyphicon glyphicon-chevron-down'></span>");
                $("#agesDrpdwn_transfer_" + ch).find('#age_transfer').val(age.trim());
            }


        } else {
            $("#childrenDrpdwnBtn_transfer").html("0 &nbsp;Children  <span class='glyphicon glyphicon-chevron-down'></span>");
            $("#childrenDrpdwnBtn_transfer").val("0");
        }

    }, 100);


$('input[name=transferOption]').change(function () {
    var value = $('input[name=transferOption]:checked').val();

    if (value != 'ROUND_TRIP') {
    } else {

        $("#transferOptionType").val('ROUND_TRIP')
        $("#returnDateDiv").css('display', 'inline-block');
        $("#returnDestTimeDiv").css('display', 'inline-block');
    }
    if (value == 'ONE_WAY') {
        $("#transferOptionType").val('ONE_WAY')
        $("#returnDateDiv").hide();
        $("#returnDestTimeDiv").hide();
    }


});

$('#autocompleter_pickup').click(function () {
        // alert("Boo");
        $("#pickupDestinationHeaderDiv h5").html("From / Pick Up Location");
        $('#pickupDestinationDiv').modal();
    });


$('input[name=pickupLocation]').change(function () {

    var value = $('input[name=pickupLocation]:checked').val();

    if (value == 'ACCOMMODATION') {

        $("#pickupLocationType").val('ACCOMMODATION')

        $("#pickupCityDiv").show();
        $("#pickupAccommodationDiv").show();
        $("#pickupTerminalDiv").hide();

    }
    if (value == 'TERMINAL') {

        $("#pickupLocationType").val('TERMINAL')

        $("#pickupCityDiv").hide();
        $("#pickupAccommodationDiv").hide();
        $("#pickupTerminalDiv").show();
    }

});


var autoCompleterUrlCountry = agent_url + '/common/autocompleter!getCountryList.html';
try {
    $("#autocompleter_country_pickup").autocomplete({
        source: function (request, response) {
                // console.log(request.term);
                $.ajax({
                    url: autoCompleterUrlCountry,
                    type: "POST",
                    dataType: "jsonp",
                    data: {
                        featureClass: "P",
                        style: "full",
                        maxRows: 12,
                        term: request.term
                    },
                    success: function (data) {
                        returnData = $.map(data.countryObjList, function (item) {
                            return {
                                label: item.myValue,
                                countryId: item.myKey
                            };
                        });
                        response(returnData);
                    }
                });
            },

            delay: 1,
            minLength: 3,
            scroll: true,
            height: 200,
            select: function (event, ui) {
                $('#pickupCountryId').val(ui.item.countryId);
                $('#pickupCountryName').val(ui.item.label);

                $("#autocompleter_city_pickup").prop("disabled", false);
                $("#autocompleter_terminal_pickup").prop("disabled", false);

            },
            open: function () {
                $(this).removeClass("ui-corner-all").addClass("ui-corner-top");
            },
            close: function () {
                $(this).removeClass("ui-corner-top").addClass("ui-corner-all");
            }
        });

} catch (ex) {
        // console.log("ERRROR while generating widget .....");
    }


    //////////
    var autoCompleterUrlCity = agent_url + '/common/autocompleter!loadCityByCountry.html';
    try {
        $("#autocompleter_city_pickup").autocomplete({
            source: function (request, response) {
                if (request.term in cache) {
                    response(cache[request.term]);
                    return;
                }
                $.ajax({
                    url: autoCompleterUrlCity,
                    type: "POST",
                    dataType: "jsonp",
                    data: {
                        featureClass: "P",
                        style: "full",
                        maxRows: 12,
                        term: request.term,
                        country: $("#pickupCountryId").val()
                    },
                    success: function (data) {
                        returnData = $.map(data.cityObjList, function (item) {
                            return {
                                label: item.myValue,
                                cityId: item.myKey
                            };
                        });
                        cache[request.term] = returnData;
                        response(returnData);
                    }
                });
            },

            delay: 300,
            minLength: 3,
            scroll: true,
            height: 200,
            select: function (event, ui) {
                $('#pickupCityName').val(ui.item.label);
                $('#pickupCityId').val(ui.item.cityId);

                $("#autocompleter_accommodation_pickup").prop("disabled", false);
            },
            open: function () {
                $(this).removeClass("ui-corner-all").addClass("ui-corner-top");
            },
            close: function () {
                $(this).removeClass("ui-corner-top").addClass("ui-corner-all");
            }
        });

    } catch (ex) {
        // console.log("ERRROR while generating widget .....");
    }


    var autoCompleterUrlHotel = agent_url + '/common/autocompleter!loadHotelsByCity.html';
    try {
        $("#autocompleter_accommodation_pickup").autocomplete({
            source: function (request, response) {
                if (request.term in cache) {
                    response(cache[request.term]);
                    return;
                }
                $.ajax({
                    url: autoCompleterUrlHotel,
                    type: "POST",
                    dataType: "jsonp",
                    data: {
                        featureClass: "P",
                        style: "full",
                        maxRows: 12,
                        term: request.term,
                        cityId: $("#pickupCityId").val()
                    },
                    success: function (data) {
                        returnData = $.map(data.hotelObjList, function (item) {
                            return {
                                label: item.myValue,
                                hotelId: item.myKey
                            };
                        });
                        cache[request.term] = returnData;
                        response(returnData);
                    }
                });
            },

            delay: 300,
            minLength: 1,
            scroll: true,
            height: 200,
            select: function (event, ui) {
                $('#pickupHotelName').val(ui.item.label);
                $('#pickupHotelId').val(ui.item.hotelId);

                $("#autocompleter_accommodation_pickup").prop("disabled", false);
            },
            open: function () {
                $(this).removeClass("ui-corner-all").addClass("ui-corner-top");
            },
            close: function () {
                $(this).removeClass("ui-corner-top").addClass("ui-corner-all");
            }
        });

    } catch (ex) {
        // console.log("ERRROR while generating widget .....");
    }


    var autoCompleterUrlTerminal = agent_url + '/common/autocompleter!loadTerminalsByCountry.html';
    try {
        $("#autocompleter_terminal_pickup").autocomplete({
            source: function (request, response) {
                if (request.term in cache) {
                    response(cache[request.term]);
                    return;
                }
                $.ajax({
                    url: autoCompleterUrlTerminal,
                    type: "POST",
                    dataType: "jsonp",
                    data: {
                        featureClass: "P",
                        style: "full",
                        maxRows: 12,
                        term: request.term,
                        country: $("#pickupCountryId").val()
                    },
                    success: function (data) {
                        // console.log('llllllllllll');
                        returnData = $.map(data.terminalObjList, function (item) {
                            return {
                                label: item.myValue,
                                terminalId: item.myKey
                            };
                        });
                        cache[request.term] = returnData;
                        response(returnData);
                    }
                });
            },

            delay: 300,
            minLength: 1,
            scroll: true,
            height: 200,
            select: function (event, ui) {
                $('#pickupTerminalName').val(ui.item.label);
                $('#pickupTerminalId').val(ui.item.terminalId);

            },
            open: function () {
                $(this).removeClass("ui-corerminalner-all").addClass("ui-corner-top");
            },
            close: function () {
                $(this).removeClass("ui-corner-top").addClass("ui-corner-all");
            }
        });

    } catch (ex) {
        // console.log("ERRROR while generating widget .....");
    }


    $('#pickupSearchLocation').click(function () {

        var value = $('input[name=pickupLocation]:checked').val();

        if (value == 'ACCOMMODATION') {
            var pickupLocation = $('#pickupHotelName').val() + ',' + $('#pickupCityName').val() + ',' + $('#pickupCountryName').val();
            $('#pickupLocationCode').val($('#pickupHotelId').val());
            $('#pickupLocationTxt').val($('#pickupHotelName').val());

            var valStatus1 = $('#autocompleter_country_pickup').valid();
            var valStatus2 = $('#autocompleter_accommodation_pickup').valid();
            var valStatus3 = $('#autocompleter_city_pickup').valid();
            var valStatus4 = $('#pickupCityName').valid();
            var valStatus5 = $('#pickupHotelName').valid();


            if (valStatus1) {
                if (valStatus2) {
                    if (valStatus3) {
                        if (valStatus4) {
                            if (valStatus5) {
                                $('#autocompleter_pickup').val(pickupLocation);
                                $('#pickupDestinationDiv').modal('toggle');
                            }
                        }
                    }
                }
            }


        } else {
            var pickupLocation = $('#pickupTerminalName').val() + ',' + $('#pickupCountryName').val();
            $('#pickupLocationCode').val($('#pickupTerminalId').val());
            $('#pickupLocationTxt').val($('#pickupTerminalName').val());

            var valStatus6 = $('#autocompleter_country_pickup').valid();
            var valStatus7 = $('#autocompleter_terminal_pickup').valid();
            var valStatus8 = $('#pickupTerminalName').valid();

            if (valStatus6) {
                if (valStatus7) {
                    if (valStatus8) {
                        $('#autocompleter_pickup').val(pickupLocation);
                        $('#pickupDestinationDiv').modal('toggle');
                    }
                }
            }

        }

    });


    $('#autocompleter_dropoff').click(function () {
        $("#dropoffDestinationHeaderDiv h5").html("To / Drop off Location");
        $('#dropoffDestinationDiv').modal('toggle');
    });

    $('input[name=dropoffLocation]').change(function () {

        var value = $('input[name=dropoffLocation]:checked').val();

        if (value == 'ACCOMMODATION') {

            $("#dropoffLocationType").val('ACCOMMODATION')

            $("#dropoffCityDiv").show();
            $("#dropoffAccommodationDiv").show();
            $("#dropoffTerminalDiv").hide();

        }
        if (value == 'TERMINAL') {

            $("#dropoffLocationType").val('TERMINAL')

            $("#dropoffCityDiv").hide();
            $("#dropoffAccommodationDiv").hide();
            $("#dropoffTerminalDiv").show();
        }

    });


    var autoCompleterUrlCountryDropoff = agent_url + '/common/autocompleter!getCountryList.html';
    try {
        $("#autocompleter_country_dropoff").autocomplete({
            source: function (request, response) {
                if (request.term in cache) {
                    response(cache[request.term]);
                    return;
                }
                $.ajax({
                    url: autoCompleterUrlCountryDropoff,
                    type: "POST",
                    dataType: "jsonp",
                    data: {
                        featureClass: "P",
                        style: "full",
                        maxRows: 12,
                        term: request.term
                    },
                    success: function (data) {
                        returnData = $.map(data.countryObjList, function (item) {
                            return {

                                label: item.myValue,
                                countryId: item.myKey
                            };
                        });
                        cache[request.term] = returnData;
                        response(returnData);
                    }
                });
            },

            delay: 300,
            minLength: 3,
            scroll: true,
            height: 200,
            select: function (event, ui) {
                $('#dropoffCountryId').val(ui.item.countryId);
                $('#dropoffCountryName').val(ui.item.label);

                $("#autocompleter_city_dropoff").prop("disabled", false);
                $("#autocompleter_terminal_dropoff").prop("disabled", false);

            },
            open: function () {
                $(this).removeClass("ui-corner-all").addClass("ui-corner-top");
            },
            close: function () {
                $(this).removeClass("ui-corner-top").addClass("ui-corner-all");
            }
        });

    } catch (ex) {
        // console.log("ERRROR while generating widget .....", ex);
    }


    var autoCompleterUrlCityyDropoff = agent_url + '/common/autocompleter!loadCityByCountry.html';

    try {
        $("#autocompleter_city_dropoff").autocomplete({
            source: function (request, response) {
                if ("dropoff_" + request.term in cache) {
                    response(cache["dropoff_" + request.term]);
                    return;
                }
                $.ajax({
                    url: autoCompleterUrlCityyDropoff,
                    type: "POST",
                    dataType: "jsonp",
                    data: {
                        featureClass: "P",
                        style: "full",
                        maxRows: 12,
                        term: request.term,
                        country: $("#dropoffCountryId").val()
                    },
                    success: function (data) {
                        returnData = $.map(data.cityObjList, function (item) {
                            return {
                                label: item.myValue,
                                cityId: item.myKey
                            };
                        });
                        cache["dropoff_" + request.term] = returnData;
                        response(returnData);
                    }
                });
            },

            delay: 300,
            minLength: 3,
            scroll: true,
            height: 200,
            select: function (event, ui) {
                $('#dropoffCityName').val(ui.item.label);
                $('#dropoffCityId').val(ui.item.cityId);

                $("#autocompleter_accommodation_dropoff").prop("disabled", false);
            },
            open: function () {
                $(this).removeClass("ui-corner-all").addClass("ui-corner-top");
            },
            close: function () {
                $(this).removeClass("ui-corner-top").addClass("ui-corner-all");
            }
        });

    } catch (ex) {
        // console.log("ERRROR while generating widget .....");
    }


    var autoCompleterUrlHotelyDropoff = agent_url + '/common/autocompleter!loadHotelsByCity.html';
    try {
        $("#autocompleter_accommodation_dropoff").autocomplete({
            source: function (request, response) {
                if (request.term in cache) {
                    response(cache[request.term]);
                    return;
                }
                $.ajax({
                    url: autoCompleterUrlHotelyDropoff,
                    type: "POST",
                    dataType: "jsonp",
                    data: {
                        featureClass: "P",
                        style: "full",
                        maxRows: 12,
                        term: request.term,
                        cityId: $("#dropoffCityId").val()
                    },
                    success: function (data) {
                        returnData = $.map(data.hotelObjList, function (item) {
                            return {
                                label: item.myValue,
                                hotelId: item.myKey
                            };
                        });
                        cache[request.term] = returnData;
                        response(returnData);
                    }
                });
            },

            delay: 300,
            minLength: 1,
            scroll: true,
            height: 200,
            select: function (event, ui) {
                $('#dropoffHotelName').val(ui.item.label);
                $('#dropoffHotelId').val(ui.item.hotelId);

                $("#autocompleter_accommodation_dropoff").prop("disabled", false);
            },
            open: function () {
                $(this).removeClass("ui-corner-all").addClass("ui-corner-top");
            },
            close: function () {
                $(this).removeClass("ui-corner-top").addClass("ui-corner-all");
            }
        });

    } catch (ex) {
        // console.log("ERRROR while generating widget .....");
    }


    var autoCompleterUrlTerminalyDropoff = agent_url + '/common/autocompleter!loadTerminalsByCountry.html';
    try {
        $("#autocompleter_terminal_dropoff").autocomplete({
            source: function (request, response) {
                if (request.term in cache) {
                    response(cache[request.term]);
                    return;
                }
                $.ajax({
                    url: autoCompleterUrlTerminalyDropoff,
                    type: "POST",
                    dataType: "jsonp",
                    data: {
                        featureClass: "P",
                        style: "full",
                        maxRows: 12,
                        term: request.term,
                        country: $("#dropoffCountryId").val()
                    },
                    success: function (data) {
                        returnData = $.map(data.terminalObjList, function (item) {
                            return {
                                label: item.myValue,
                                terminalId: item.myKey
                            };
                        });
                        cache[request.term] = returnData;
                        response(returnData);
                    }
                });
            },

            delay: 300,
            minLength: 2,
            scroll: true,
            height: 200,
            select: function (event, ui) {
                $('#dropoffTerminalName').val(ui.item.label);
                $('#dropoffTerminalId').val(ui.item.terminalId);

            },
            open: function () {
                $(this).removeClass("ui-corerminalner-all").addClass("ui-corner-top");
            },
            close: function () {
                $(this).removeClass("ui-corner-top").addClass("ui-corner-all");
            }
        });

    } catch (ex) {
        // console.log("ERRROR while generating widget .....");
    }


    $('#dropoffSearchLocation').click(function () {


        var value = $('input[name=dropoffLocation]:checked').val();

        if (value == 'ACCOMMODATION') {
            var dropoffLocation = $('#dropoffHotelName').val() + ',' + $('#dropoffCityName').val() + ',' + $('#dropoffCountryName').val();
            $('#dropoffLocationCode').val($('#dropoffHotelId').val());
            $('#dropoffLocationTxt').val($('#dropoffHotelName').val());

            var valStatus1 = $('#autocompleter_country_dropoff').valid();
            var valStatus2 = $('#autocompleter_accommodation_dropoff').valid();
            var valStatus3 = $('#autocompleter_city_dropoff').valid();
            var valStatus4 = $('#dropoffCityName').valid();
            var valStatus5 = $('#dropoffHotelName').valid();

            if (valStatus1) {
                if (valStatus2) {
                    if (valStatus3) {
                        if (valStatus4) {
                            if (valStatus5) {
                                $('#autocompleter_dropoff').val(dropoffLocation);
                                $('#dropoffDestinationDiv').modal('toggle');
                            }
                        }
                    }
                }
            }

        } else {
            var dropoffLocation = $('#dropoffTerminalName').val() + ',' + $('#dropoffCountryName').val();
            $('#dropoffLocationCode').val($('#dropoffTerminalId').val());
            $('#dropoffLocationTxt').val($('#dropoffTerminalName').val());

            var valStatus6 = $('#autocompleter_country_dropoff').valid();
            var valStatus7 = $('#autocompleter_terminal_dropoff').valid();
            var valStatus8 = $('#dropoffTerminalName').valid();

            if (valStatus6) {
                if (valStatus7) {
                    if (valStatus8) {
                        $('#autocompleter_dropoff').val(dropoffLocation);
                        $('#dropoffDestinationDiv').modal('toggle');
                    }
                }
            }

        }


    });


});
/** TRANSFER SCRIPTS :: ENDS */

/** ACTIVITIES SCRIPTS */

try {

    jQuery.validator.setDefaults({
        debug: true,
        success: "valid"
    });

} catch (e) {
}
;

try {
    jQuery(document).ready(function ($) {

        $("#searchboxform_activity").validate({
            ignore: "",
            rules: {
                autocompleter_city_a: "required"
            },

            messages: {
                autocompleter_city_a: "is required",
            },


            // specifying a submitHandler prevents the default submit, good for the demo
            submitHandler: function () {
                //alert("submitted!");
            }
        });
    });
} catch (e) {
    alert(e);
}


jQuery(document).ready(function($){
    (function ($) {

        var act_adjustToDate = function (nights) {
            var fromDate = $("#activities .activity_from_date").datepicker('getDate');

            if (!isNaN(fromDate)) {
                $("#noofnights").val(nights);

                var endDate = fromDate;
                var minDateObj = new Date(endDate);
                var minDate = new Date(minDateObj.getFullYear(), minDateObj.getMonth(), minDateObj.getDate() + 1);
                endDate.setDate(endDate.getDate() + Number(nights));

                $("#activities .activity_return_date").datepicker('setStartDate', minDate);
                $('#activities .activity_return_date').datepicker('setDate', endDate);
            }
        };

        $('#activities .activity_from_date').datepicker({
            language: 'en',
            format: "dd-M-yyyy",
            startDate: "0d",
            forceParse: 'false',
            startView: 0,
            minViewMode: 0,
            todayBtn: "linked",
            autoclose: true,
            todayHighlight: true
        }).on('changeDate', function (ev) {
            act_adjustToDate(2);
        });

        $('#activities .activity_return_date').datepicker({
            language: 'en',
            format: "dd-M-yyyy",
            startDate: "+1",
            forceParse: 'false',
            startView: 0,
            minViewMode: 0,
            autoclose: true,
            todayHighlight: true
        }).on('changeDate', function (ev) {
            var toDate = $("#activities .activity_return_date").datepicker('getDate');
            if (!isNaN(toDate)) {
                var checkIn = $("#activities .activity_from_date").datepicker('getDate');
                var checkOut = $("#activities .activity_return_date").datepicker('getDate');
                var oneDay = 1000 * 60 * 60 * 24;
                var dateDifferent = Math.ceil((checkOut - checkIn) / oneDay);
                if (dateDifferent >= 1 && dateDifferent <= 30) {
                } else if (dateDifferent < 1) {
                } else if (dateDifferent > 30) {
                    initNightsDropDown(30);
                    checkOut.setDate(checkOut.getDate() - 30);
                    $('#activities .activity_from_date').datepicker('setDate', checkOut);
                }
            }
        });


        var frmDate = new Date();
        frmDate.setDate(frmDate.getDate() + 3);
        $('#activities .activity_from_date').datepicker('setDate', frmDate).datepicker('update');


        var toDate = new Date();
        toDate.setDate(toDate.getDate() + 5);
        $('#activities .activity_return_date').datepicker('setDate', toDate).datepicker('update');

        var hhText = 'hh';
        var mmText = 'mm';

        var adltText = 'Adult(s)';
        $("#adultsDrpdwnUl_activity li a").click(function () {
            $(this).parents('.dropdown').find('.btn').html($(this).text() + ' ' + adltText + ' ' + dropDownIconStyle);
            $(this).parents(".dropdown").find('.btn').val($(this).data('value'));
            $("#activityTotalAdults").val($(this).data('value'));
        });

        var childText = 'Children';
        $("#childrenDrpdwnUl_activity li a").click(function () {
            $(this).parents('.dropdown').find('.btn').html($(this).text() + ' ' + childText + ' ' + dropDownIconStyle);
            $(this).parents(".dropdown").find('.btn').val($(this).data('value'));
            $("#activityTotalChildren").val($(this).data('value'));


            $("#act-ages").hide();

            for (var ch = 1; ch <= 40; ch++) {
                $("#agesDrpdwn_activity_" + ch).find('#activityChildaAge').prop('disabled', true);
                $("#agesDrpdwn_activity_" + ch).hide();
            }


            if ($(this).data('value') > 0) {

                //  $("#age_lbl_"+arr[1]).show();
                $("#act-ages").show();

                for (var ch = 1; ch <= $(this).data('value'); ch++) {
                    $("#agesDrpdwn_activity_" + ch).find('#activityChildaAge').prop('disabled', false);
                    $("#agesDrpdwn_activity_" + ch).show();
                }

            }
        });


        $("#agesDrpdwnUl_activity li a").click(function () {
            $(this).parents('.dropdown').find('.btn').html($(this).text() + ' ' + dropDownIconStyle);
            var selctdAge = $(this).data('value');
            console.log("activityChildaAge =============== " + selctdAge);
            console.log("activityChildaAge =============== " + $(this).parents(".dropdown").find('#activityChildaAge'));
            $(this).parents(".dropdown").find('.btn').val(selctdAge);
            $(this).parents(".dropdown").find('#activityChildaAge').val(selctdAge);
        });

        $("#searchboxform_activity").submit(function (e) {
            var self = this;
            e.preventDefault();

            console.log("valid-->" + $("#searchboxform_activity").valid());

            var m_names = new Array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
            var fromDate = new Date($(".input-group.date.activity_from_date").datepicker('getDate'));
            var toDate = new Date($(".input-group.date.activity_return_date").datepicker('getDate'));

            $("#activityDatefrom").val(fromDate.getDate() + "-" + m_names[fromDate.getMonth()] + "-" + fromDate.getFullYear());
            $("#activityDateto").val(toDate.getDate() + "-" + m_names[toDate.getMonth()] + "-" + toDate.getFullYear());

            if ($("#searchboxform_activity").valid()) {
                self.submit();
            } else {
                console.log("NOT VALIDE");
            }


        });


        setTimeout(function () {


            if ('' != '') {
                $("#autocompleter_city_a").val("");
            }

            if ('' != '') {
                $('.input-group.date.activity_from_date').datepicker('setDate', '');
            }

            if ('' != '') {
                $('.input-group.date.activity_return_date').datepicker('setDate', '');
            }

            if ("1" != '') {
                $("#adultsDrpdwnBtn_activity").html("1 &nbsp;Adult  <span class='glyphicon glyphicon-chevron-down'></span>");
                $("#adultsDrpdwnBtn_activity").val("1");
            } else {
                $("#adultsDrpdwnBtn_activity").html("1 &nbsp;Adult  <span class='glyphicon glyphicon-chevron-down'></span>");
                $("#adultsDrpdwnBtn_activity").val("1");
            }

            if ("0" != '' && "0" != '0') {

                $("#childrenDrpdwnBtn_activity").html("0 &nbsp;Children  <span class='glyphicon glyphicon-chevron-down'></span>");
                $("#childrenDrpdwnBtn_activity").val("0");


                $("#act-ages").show();

//                  console.log("activityChildaAge -->"+ '');

var childArr = ''.split(",");

var childCnt = [0];
for (var ch = 1; ch <= childCnt; ch++) {
    var activityChildaAge = childArr[ch - 1];
    $("#agesDrpdwn_activity_" + ch).find('#activityChildaAge').prop('disabled', false);
    $("#agesDrpdwn_activity_" + ch).show();
                    //$("#agesDrpdwn_transfer_"+ch).val(activityChildaAge);

                    $("#agesDrpdwn_activity_" + ch).find('.btn').val(activityChildaAge.trim());
                    $("#agesDrpdwn_activity_" + ch).find('.btn').html(activityChildaAge + " <span class='glyphicon glyphicon-chevron-down'></span>");
                    $("#agesDrpdwn_activity_" + ch).find('#activityChildaAge').val(activityChildaAge.trim());
                }


            } else {
                $("#childrenDrpdwnBtn_activity").html("0 &nbsp;Children  <span class='glyphicon glyphicon-chevron-down'></span>");
                $("#childrenDrpdwnBtn_activity").val("0");
            }

        }, 100);

        var autoCompleterUrl = agent_url + '/common/autocompleter!getLocationList.html';

        try {
            $("#autocompleter_city_a").autocomplete({

                source: function (request, response) {
                    if (request.term in cache) {
                        response(cache[request.term]);
                        return;
                    }
                    $.ajax({
                        url: autoCompleterUrl,
                        type: "POST",
                        dataType: "jsonp",
                        data: {
                            featureClass: "P",
                            style: "full",
                            term: request.term
                        },
                        success: function (data) {
                            returnData = $.map(data.cityNameIdList, function (item) {
                                return {
                                    label: item.myValue,
                                    cityId: item.myKey
                                };
                            });
                            cache[request.term] = returnData;
                            response(returnData);
                        }
                    });
                },

                delay: 200,
                minLength: 3,
                scroll: true,
                height: 200,
                select: function (event, ui) {
                    $('#activityCityName').val(ui.item.label);
                    $('#activityCityId').val(ui.item.cityId);
                    //$('.from_date' ).find('span.input-group-addon').click();
                },
                open: function () {
                    $(this).removeClass("ui-corner-all").addClass("ui-corner-top");
                },
                close: function () {
                    $(this).removeClass("ui-corner-top").addClass("ui-corner-all");
                }
            });

        } catch (ex) {
            console.log("ERRROR while generating widget .....");
        }


    })(jQuery);
})


/** ACTIVITIES SCRIPTS :: ENDS */


/** CAR RENT SCRIPT */
var carLocationCache = {};

jQuery(document).ready(function($){
    (function ($) {

        jQuery.validator.setDefaults({
            debug: true,
            success: "valid"
        });

        $("#searchboxform_car").validate({
            ignore: "",
            rules: {
                autocompleter_car_pickup: "required",
                autocompleter_car_return: {
                    required: {
                        depends: function () {
                            return (!$("#returnToSame").is(":checked"));
                        }
                    }
                },
                driverAge: {required: true, min: 21, number: true}
            },
            messages: {
                autocompleter_car_pickup: "is required",
                autocompleter_car_return: "is required",
                driverAge: "Driver's age should be greater than 21 years"
            },

            // specifying a submitHandler prevents the default submit, good for the demo
            submitHandler: function () {
                //alert("submitted!");
            }

        });


        $("#autocompleter_car_pickup").focus(function (e) {
            $(this).val("");
            $("#carPickLocationTxt").val("");
            $("#carPickLocationCode").val("-");
        });

        $('#autocompleter_car_pickup').on('input', function (e) {
            e.target.setCustomValidity('');
        });

        $("#autocompleter_car_return").focus(function (e) {
            $(this).val("");
            $("#carReturnLocationTxt").val("");
            $("#carReturnLocationCode").val("-");
        });

        $('#autocompleter_car_return').on('input', function (e) {
            e.target.setCustomValidity('');
        });


        var car_adjustToDate = function (nights) {
            var fromDate = $("#car-rent .pickup_date").datepicker('getDate');

            if (!isNaN(fromDate)) {
                $("#noofnights").val(nights);

                var endDate = fromDate;
                var minDateObj = new Date(endDate);
                var minDate = new Date(minDateObj.getFullYear(), minDateObj.getMonth(), minDateObj.getDate() + 1);
                endDate.setDate(endDate.getDate() + Number(nights));

                $("#car-rent .return_date").datepicker('setStartDate', minDate);
                $('#car-rent .return_date').datepicker('setDate', endDate);
            }
        };


        $('#car-rent .pickup_date').datepicker({
            language: 'en',
            format: "dd-M-yyyy",
            startDate: "0d",
            forceParse: 'false',
            startView: 0,
            minViewMode: 0,
            todayBtn: "linked",
            autoclose: true,
            todayHighlight: true
        }).on('changeDate', function (ev) {
            car_adjustToDate(2);
        });

        $('#car-rent .return_date').datepicker({
            language: 'en',
            format: "dd-M-yyyy",
            startDate: "+1",
            forceParse: 'false',
            startView: 0,
            minViewMode: 0,
            autoclose: true,
            todayHighlight: true
        }).on('changeDate', function (ev) {
            var toDate = $("#car-rent .return_date").datepicker('getDate');
            if (!isNaN(toDate)) {
                var checkIn = $("#car-rent .pickup_date").datepicker('getDate');
                var checkOut = $("#car-rent .return_date").datepicker('getDate');
                var oneDay = 1000 * 60 * 60 * 24;
                var dateDifferent = Math.ceil((checkOut - checkIn) / oneDay);
                if (dateDifferent >= 1 && dateDifferent <= 30) {
                } else if (dateDifferent < 1) {
                } else if (dateDifferent > 30) {
                    initNightsDropDown(30);
                    checkOut.setDate(checkOut.getDate() - 30);
                    $('#car-rent .pickup_date').datepicker('setDate', checkOut);
                }
            }
        });


        var frmDate = new Date();
        frmDate.setDate(frmDate.getDate() + 3);
        $('#car-rent .pickup_date').datepicker('setDate', frmDate).datepicker('update');


        var toDate = new Date();
        toDate.setDate(toDate.getDate() + 5);
        $('#car-rent .return_date').datepicker('setDate', toDate).datepicker('update');


        var hhText = 'hh';
        var mmText = 'mm';

        $("#pickupTimeUl_hh li a").click(function () {
            console.log('======' + $(this).text().trim());
            $(this).parents('.dropdown').find('.btn').html($(this).text() + ' ' + hhText + ' ' + dropDownIconStyle);
            $(this).parents(".dropdown").find('.btn').val($(this).data('value'));
            $("#pickuphh").val($(this).data('value'));
        });

        $("#pickupTimeUl_mm li a").click(function () {
            $(this).parents('.dropdown').find('.btn').html($(this).text() + ' ' + mmText + ' ' + dropDownIconStyle);
            $(this).parents(".dropdown").find('.btn').val($(this).data('value'));
            $("#pickupmm").val($(this).data('value'));
        });

        $("#dropoffTimeUl_hh li a").click(function () {
            $(this).parents('.dropdown').find('.btn').html($(this).text() + ' ' + hhText + ' ' + dropDownIconStyle);
            $(this).parents(".dropdown").find('.btn').val($(this).data('value'));
            $("#dropoffhh").val($(this).data('value'));
        });

        $("#dropoffTimeUl_mm li a").click(function () {
            $(this).parents('.dropdown').find('.btn').html($(this).text() + ' ' + mmText + ' ' + dropDownIconStyle);
            $(this).parents(".dropdown").find('.btn').val($(this).data('value'));
            $("#dropoffmm").val($(this).data('value'));
        });

        $("#returndestTimeUl_hh li a").click(function () {
            $(this).parents('.dropdown').find('.btn').html($(this).text() + ' ' + hhText + ' ' + dropDownIconStyle);
            $(this).parents(".dropdown").find('.btn').val($(this).data('value'));
            $("#returnDesthh").val($(this).data('value'));
        });

        $("#returndestTimeUl_mm li a").click(function () {
            $(this).parents('.dropdown').find('.btn').html($(this).text() + ' ' + mmText + ' ' + dropDownIconStyle);
            $(this).parents(".dropdown").find('.btn').val($(this).data('value'));
            $("#returnDestmm").val($(this).data('value'));
        });


        $("#searchboxform_car").submit(function (e) {
            var self = this;
            e.preventDefault();

            if ($('#carPickLocationCode').val() == "-") {

                $("#autocompleter_car_pickup").popover({
                    placement: 'bottom',
                    content: 'Please select a pickup location from the list'
                }).popover('show');
                return;
            }

            if ($('#carReturnLocationCode').val() == "-") {

                $("#autocompleter_car_return").popover({
                    placement: 'bottom',
                    content: 'Please select a return location from the list'
                }).popover('show');
                return;
            }


            var fromDate = new Date($("#car-rent .pickup_date").datepicker('getDate'));

            var frmtedFromMonth = (fromDate.getMonth() + 1).toString();
            var frmtedFromDay = fromDate.getDate().toString();
            if (frmtedFromMonth.length == 1) frmtedFromMonth = "0" + frmtedFromMonth;
            if (frmtedFromDay.length == 1) frmtedFromDay = "0" + frmtedFromDay;

            $("#car-rent #pickupDate").val(fromDate.getFullYear() + "-" + frmtedFromMonth + "-" + frmtedFromDay);
            $("#car-rent #carPickDateOriginal").val($("#tmp_date_pickup_date").val());


            var toDate = new Date($(".input-group.date.return_date").datepicker('getDate'));

            var frmtedToMonth = (toDate.getMonth() + 1).toString();
            var frmtedToDay = toDate.getDate().toString();
            if (frmtedToMonth.length == 1) frmtedToMonth = "0" + frmtedToMonth;
            if (frmtedToDay.length == 1) frmtedToDay = "0" + frmtedToDay;

            $("#carReturnDate").val(toDate.getFullYear() + "-" + frmtedToMonth + "-" + frmtedToDay);
            $("#carReturnDateOriginal").val($("#tmp_date_return_date").val());

            if ($("#searchboxform_car").valid()) {
                self.submit();
            } else {
                console.log("NOT VALID");
            }


        });


        setTimeout(function () {
            if ('' != '') {
                $("#autocompleter_car_pickup").val("");
            }

            if ('' != '') {
                $("#autocompleter_car_return").val("");
            }

            if ('' != '') {
                $("#carPickLocationCode").val("");
            }
            if ('' != '') {
                $("#carReturnLocationCode").val("");
            }

            var carPickLocationType = '';
            if (carPickLocationType != '') {
                $("#carPickLocationType").val(carPickLocationType);
                $("#carPickupTypeBtn").val(carPickLocationType);
                if ("TERMINAL" == carPickLocationType) {
                    carPickLocationType = "Airport";
                } else {
                    carPickLocationType = "Downtown";
                }
                $("#carPickupTypeBtn").html(carPickLocationType + " <span class='glyphicon glyphicon-chevron-down'></span>");
            }

            var carReturnLocationType = '';
            if (carReturnLocationType != '') {
                $("#carReturnLocationType").val(carReturnLocationType);
                $("#carReturnTypeBtn").val(carReturnLocationType);
                if ("TERMINAL" == carReturnLocationType) {
                    carReturnLocationType = "Airport";
                } else {
                    carReturnLocationType = "Downtown";
                }
                $("#carReturnTypeBtn").html(carReturnLocationType + " <span class='glyphicon glyphicon-chevron-down'></span>");
            }


            if ('' != '') {
                $("#carPickLocationId").val("");
            }
            if ('' != '') {
                $("#carPickcityCode").val("");
            }
            if ('' != '') {
                $("#carReturnLocationId").val("");
            }
            if ('' != '') {
                $("#carReturnCityCode").val("");
            }


            if ('' != '') {
                $('.input-group.date.pickup_date').datepicker('setDate', '');
                $("#dropoffTerminalName").val("");

                $("#pickupTime_hh").find('.btn').val("");
                $("#pickupTime_hh").find('.btn').html("" + ' ' + hhText + ' ' + dropDownIconStyle);
                $("#pickupTime_mm").find('.btn').val("");
                $("#pickupTime_mm").find('.btn').html("" + ' ' + mmText + ' ' + dropDownIconStyle);
            }

            if ('' != '') {
                $('.input-group.date.return_date').datepicker('setDate', '');
                $("#returndestTime_hh").find('.btn').val("");
                $("#returndestTime_hh").find('.btn').html("" + ' ' + hhText + ' ' + dropDownIconStyle);
                $("#returndestTime_mm").find('.btn').val("");
                $("#returndestTime_mm").find('.btn').html("" + ' ' + mmText + ' ' + dropDownIconStyle);
            }

            if ('0' != '' && '0' != 0) {
                $("#driverAge").val("0");
            }

            if ('false' == true) {
                $("#returnToSame").prop("checked", 'false');
                $("#car_returntype_div").hide();
                $("#autocompleter_car_return_div").hide();
            }
        }, 100);


        var autoCompleterUrlTerminal = agent_url + '/common/autocompleter!getAirportList.html';
        try {
            $("#autocompleter_car_pickup,#autocompleter_car_return").autocomplete({
                source: function (request, response) {
                    if (request.term in carLocationCache) {
                        response(carLocationCache[request.term]);
                        return;
                    }
                    $.ajax({
                        url: autoCompleterUrlTerminal,
                        type: "POST",
                        dataType: "jsonp",
                        data: {
                            featureClass: "P",
                            style: "full",
                            maxRows: 12,
                            term: request.term
                        },
                        success: function (data) {
                            //console.log('llllllllllll');
                            returnData = $.map(data.airPortCodeList, function (item) {
                                return {
                                    label: item.myValue,
                                    code: item.myKey
                                };
                            });
                            carLocationCache[request.term] = returnData;
                            response(returnData);
                        }
                    });
                },

                delay: 300,
                minLength: 3,
                scroll: true,
                height: 200,
                select: function (event, ui) {

                    var carAction = "";
                    if ("autocompleter_car_pickup" == this.id) {
                        $('#carPickLocationTxt').val(ui.item.label);
                        $('#carPickLocationCode').val(ui.item.code);
                        carAction = "PICKUP";

                        if ($("#returnToSame").is(":checked")) {
                            $('#carReturnLocationTxt').val(ui.item.label);
                            $('#autocompleter_car_return').val(ui.item.label);
                            $('#carReturnLocationCode').val(ui.item.code);

                            var returnTypeTxt = '-';
                            if ("TERMINAL" == $('#carPickLocationType').val()) {
                                returnTypeTxt = "Airport";
                            } else {
                                returnTypeTxt = "Downtown";
                            }

                            $('#carReturnTypeBtn').html(returnTypeTxt + ' ' + dropDownIconStyle);
                            $('#carReturnTypeBtn').val($('#carPickLocationType').val());
                            $('#carReturnLocationType').val($('#carPickLocationType').val());

                            $('#carReturnLocationId').val($('#carPickLocationId').val());
                            $('#carReturnCityCode').val($('#carPickCityCode').val());
                        }

                    } else if ("autocompleter_car_return" == this.id) {
                        $('#carReturnLocationTxt').val(ui.item.label);
                        $('#carReturnLocationCode').val(ui.item.code);
                        carAction = "RETURN";
                    }

                    var locationType = $(this).parent("div").parent("div").prev().find("input").val();
                    //alert(locationType);

                    if (locationType == "DOWNTOWN") {

                        var postData = {
                            airportCode: ui.item.code,
                            carAction: carAction
                        };

                        if (carAction == "PICKUP") {
                            $('#img_load_p').show();
                        } else {
                            $('#img_load_r').show();
                        }

                        $.ajax({
                            type: 'POST',
                            cache: false,
                            url: '/common/autocompleter!getDowntownLocations.html',
                            data: postData,
                            dataType: 'html',
                            success: function (data) {

                                $('#downtown_locations_div').html(data);
                                $('#downtownDestinationDiv').modal('toggle');
                            }
                        });
                        ui.item.value = "";
                    }
                },
                open: function () {
                    $(this).removeClass("ui-corerminalner-all").addClass("ui-corner-top");
                },
                close: function () {
                    $(this).removeClass("ui-corner-top").addClass("ui-corner-all");
                }
            });

} catch (ex) {
    console.log("ERRROR while generating widget .....");
}


$("#carPickupTypeBtnUl li a").click(function () {

    var pickupType = $(this).data('value');

    $("#autocompleter_car_pickup").val("");

    console.log("pickupType=" + pickupType);

    $(this).parents('.dropdown').find('.btn').html($(this).text() + ' ' + dropDownIconStyle);
    $(this).parents(".dropdown").find('.btn').val(pickupType);
    $('#carPickLocationType').val(pickupType);
});

$("#carReturnTypeBtnUl li a").click(function () {

    var returnType = $(this).data('value');

    $("#autocompleter_car_return").val("");

    $(this).parents('.dropdown').find('.btn').html($(this).text() + ' ' + dropDownIconStyle);
    $(this).parents(".dropdown").find('.btn').val(returnType);
    $('#carReturnLocationType').val(returnType);
});

$('#carPickupSearchLocation').click(function () {
    $('#img_load_p').hide();
    $('#img_load_r').hide();
    $('#downtownDestinationDiv').modal('toggle');
});


$("#returnToSame").change(function () {
    if ($(this).is(":checked")) {
        $('#carReturnLocationTxt').val($("#carPickLocationTxt").val());
        $('#autocompleter_car_return').val($("#carPickLocationTxt").val());
        $('#carReturnLocationCode').val($("#carPickLocationCode").val());

        var returnType = $('#carPickLocationType').val();
        var returnTypeTxt = '-';
        if ("TERMINAL" == returnType) {
            returnTypeTxt = "Airport";
        } else {
            returnTypeTxt = "Downtown";
        }

        $('#carReturnTypeBtn').html(returnTypeTxt + ' ' + dropDownIconStyle);
        $('#carReturnTypeBtn').val(returnType);
        $('#carReturnLocationType').val(returnType);

        $('#carReturnLocationId').val($('#carPickLocationId').val());
        $('#carReturnCityCode').val($('#carPickCityCode').val());

        $("#car_returntype_div").hide();
        $("#autocompleter_car_return_div").hide();
    } else {
        $("#car_returntype_div").show();
        $("#autocompleter_car_return_div").show();
    }
});


})(jQuery);
})
/** CAR RENT SCRIPT :: ENDS */

/** FLIGHTS SCRIPT */
var dropDownIconStyle = '<span class="test glyphicon glyphicon-chevron-down"></span>';

jQuery(document).ready(function($){
    (function ($) {

        var autoCompleterUrl = agent_url + '/common/autocompleter!getAirportList.html';
        try {
            $("#autocompleter_from,#autocompleter_to").autocomplete({
                source: function (request, response) {
                    if (request.term in cache) {
                        response(cache[request.term]);
                        return;
                    }
                    $.ajax({
                        url: autoCompleterUrl,
                        type: "POST",
                        dataType: "jsonp",
                        data: {
                            featureClass: "P",
                            style: "full",
                            maxRows: 12,
                            term: request.term
                        },
                        success: function (data) {
                            returnData = $.map(data.airPortCodeList, function (item) {
                                return {
                                    label: item.myValue,
                                    airPortCode: item.myKey
                                };
                            });
                            cache[request.term] = returnData;
                            response(returnData);
                        }
                    });
                },

                delay: 300,
                minLength: 3,
                scroll: true,
                height: 200,
                select: function (event, ui) {
                    if ("autocompleter_from" == this.id) {
                        $('#departAirportText').val(ui.item.label);
                        $('#departAirportCode').val(ui.item.airPortCode);
                    } else if ("autocompleter_to" == this.id) {
                        $('#arrivalAirportText').val(ui.item.label);
                        $('#arrivalAirportCode').val(ui.item.airPortCode);
                        $('.depart_date').find('span.input-group-addon').click();


                    }
                },
                open: function () {
                    $(this).removeClass("ui-corner-all").addClass("ui-corner-top");
                },
                close: function () {
                    $(this).removeClass("ui-corner-top").addClass("ui-corner-all");
                }
            });

        } catch (ex) {
            console.log("ERRROR while generating flight autocompleters .....");
        }

        $("#autocompleter_from").focus(function (e) {
            $(this).val("");
            $("#departAirportText").val("");
            $("#departAirportCode").val(0);
        });

        $('#autocompleter_from').on('input', function (e) {
            e.target.setCustomValidity('');
        });

        $("#autocompleter_to").focus(function (e) {
            $(this).val("");
            $("#arrivalAirportText").val("");
            $("#arrivalAirportCode").val(0);
        });

        $('#autocompleter_to').on('input', function (e) {
            e.target.setCustomValidity('');
        });

        adjustDate = function (type) {
            var fromDate = $("#flights .depart_date").datepicker('getDate');
            var toDate = $("#flights .arrival_date").datepicker('getDate');

            if ($("#tripType").val() == 'RETURN' && !isNaN(fromDate) && !isNaN(toDate)) {

                if (fromDate > toDate) {

                    if (type == 'd') {
                        $("#flights .arrival_date").datepicker("update", fromDate);
                    } else {
                        $("#flights .depart_date").datepicker("update", toDate);
                    }

                }

                if (type == 'd') {
                    $('.arrival_date').find('span.input-group-addon').click();
                }

            } else if ($("#tripType").val() == 'ONE_WAY' && !isNaN(fromDate)) {

                if (type == 'r') {

                    if (fromDate > toDate) {
                        $("#flights .depart_date").datepicker("update", toDate);
                    }
                    $("#rtlinkId")[0].click();
                }


            }
        };


        $('#flights .depart_date').datepicker({
            language: 'en',
            format: "dd-M-yyyy",
            startDate: "0d",
            endDate: '+1y -3d',
            forceParse: 'false',
            startView: 0,
            minViewMode: 0,
            todayBtn: "linked",
            autoclose: true,
            todayHighlight: true,
            todayBtn: false
        }).on('changeDate', function (ev) {
            adjustDate('d');
        });

        $('#flights .arrival_date').datepicker({
            language: 'en',
            format: "dd-M-yyyy",
            startDate: "0d",
            endDate: '+1y',
            forceParse: 'false',
            startView: 0,
            minViewMode: 0,
            autoclose: true,
            todayHighlight: true,
            todayBtn: false
        }).on('changeDate', function (ev) {
            adjustDate('r');
        });

        var curruntDate = new Date();
        curruntDate.setDate(curruntDate.getDate() + 10);
        $("#flights .depart_date").datepicker("update", curruntDate);
        curruntDate.setDate(curruntDate.getDate() + 5);
        $("#flights .arrival_date").datepicker("update", curruntDate);

        $("#passengerDrpdwnUl li a").on('click', function (event) {
            if (!($(this).parents().hasClass('closeme'))) {

                event.stopPropagation();

                if ($(this).parents().hasClass('adtpasseng')) {

                    if ($(this).hasClass('plus')) {
                        if ($("#noOfAdults").val() <= 8) {
                            $("#noOfAdults").val(parseInt($("#noOfAdults").val()) + 1);
                        }
                    } else {
                        if ($("#noOfAdults").val() > 1) {
                            $("#noOfAdults").val(parseInt($("#noOfAdults").val()) - 1);
                        }
                    }

                } else if ($(this).parents().hasClass('childpasseng')) {

                    if ($(this).hasClass('plus')) {
                        if ($("#noOfChildren").val() <= 8) {
                            $("#noOfChildren").val(parseInt($("#noOfChildren").val()) + 1);
                        }
                    } else {
                        if ($("#noOfChildren").val() > 0) {
                            $("#noOfChildren").val(parseInt($("#noOfChildren").val()) - 1);
                        }
                    }

                } else if ($(this).parents().hasClass('infapasseng')) {

                    if ($(this).hasClass('plus')) {
                        if ($("#noOfInfants").val() <= 6) {
                            $("#noOfInfants").val(parseInt($("#noOfInfants").val()) + 1);
                        }
                    } else {

                        if ($("#noOfInfants").val() > 0) {
                            $("#noOfInfants").val(parseInt($("#noOfInfants").val()) - 1);
                        }
                    }

                } else {
                    console.log('no class found');
                }

                updatePassengerTot();

            }


        });

        var updatePassengerTot = function () {

            var totalPasseng = parseInt($("#noOfAdults").val()) + parseInt($("#noOfChildren").val()) + parseInt($("#noOfInfants").val());

            var pText = totalPasseng + " Passenger";

            if (totalPasseng > 1) {
                pText = pText + "s";
            }

            $("#passengerDrpdwnUl").parents('.dropdown').find('.btn').find('#ctt').html(pText);
        };


        $("#searchboxform_flight").submit(function (e) {
            var self = this;
            e.preventDefault();

            if ($('#departAirportCode').val() == '' || $('#departAirportCode').val() == '0') {

                $("#autocompleter_from").popover({
                    placement: 'bottom',
                    content: 'Select Airport'
                }).popover('show');
                return;
            }

            if ($('#arrivalAirportCode').val() == '' || $('#arrivalAirportCode').val() == '0') {

                $("#autocompleter_to").popover({
                    placement: 'bottom',
                    content: 'Select Airport'
                }).popover('show');
                return;
            }

            if ($("#noOfInfants").val() > $("#noOfAdults").val()) {
                $("#div-alert-error").html("No. of infants cannot be more than adults");
                $("#alert-error").show();
                return;
            } else {
                $("#div-alert-error").hide();
            }

            /*var m_names = new Array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");*/
            var fromDate = new Date($("#flights .depart_date").datepicker('getDate'));
            var toDate = new Date($("#flights .arrival_date").datepicker('getDate'));

            var frmtedFromMonth = (fromDate.getMonth() + 1).toString();
            var frmtedToMonth = (toDate.getMonth() + 1).toString();
            var frmtedFromDay = fromDate.getDate().toString();
            var frmtedToDay = toDate.getDate().toString();
            if (frmtedFromMonth.length == 1) frmtedFromMonth = "0" + frmtedFromMonth;
            if (frmtedToMonth.length == 1) frmtedToMonth = "0" + frmtedToMonth;
            if (frmtedFromDay.length == 1) frmtedFromDay = "0" + frmtedFromDay;
            if (frmtedToDay.length == 1) frmtedToDay = "0" + frmtedToDay;

            if ($("#departAirportText").val() == '') {
                $("#departAirportText").val($("#autocompleter_from").val());
                $("#departAirportCode").val($("#autocompleter_from").val());
            }
            if ($("#arrivalAirportText").val() == '') {
                $("#arrivalAirportText").val($("#autocompleter_to").val());
                $("#arrivalAirportCode").val($("#autocompleter_to").val());
            }


            $("#departureDate").val(fromDate.getFullYear() + "-" + frmtedFromMonth + "-" + frmtedFromDay);
            $("#flights #returnDate").val(toDate.getFullYear() + "-" + frmtedToMonth + "-" + frmtedToDay);
            $("#departureDateOriginal").val($("#tmp_date_depart_date").val());
            $("#flights #returnDateOriginal").val($("#tmp_date_return_date").val());


            if ($('#departureDateOriginal').val() == '') {

                $("#tmp_date_depart_date").popover({
                    placement: 'bottom',
                    content: 'Invalid Date'
                }).popover('show');
                return;
            }

            if ($('#flights #returnDateOriginal').val() == '') {

                $("#tmp_date_return_date").popover({
                    placement: 'bottom',
                    content: 'Invalid Date'
                }).popover('show');
                return;
            }

            self.submit();
        });


        $("#tripTypeDrpdwnUl li a").click(function () {

            $(this).parents('.dropdown').find('.btn').find('#ctticon').prop('class', ($(this).find('span').prop('class')));
            $(this).parents('.dropdown').find('.btn').find('#ctt').html($(this).text());
            var tripType = $(this).data('value');
            $(this).parents(".dropdown").find('.btn').val(tripType);
            $("#tripType").val(tripType);

            if (tripType == 'ONE_WAY') {

                $("#tmp_date_return_date").val('—');
                $("#tmp_date_return_date").prop('placeholder', '—');
            } else {
                var fromDate = $("#flights .depart_date").datepicker('getDate');
                $("#flights .arrival_date").datepicker("update", fromDate);
            }
        });

        $("#cabinTypeDrpdwnUl li a").click(function () {
            $(this).parents('.dropdown').find('.btn').find('#ctt').html($(this).text());
            var cabinType = $(this).data('value');
            $(this).parents(".dropdown").find('.btn').val(cabinType);
            $("#cabinPref").val(cabinType);
        });


        setTimeout(function () {

            $("#autocompleter_from").val("");
            $("#autocompleter_to").val("");

            if ($('#departAirportCode').val() == null || $('#departAirportCode').val() == '') {

                $("#autocompleter_from").val("Colombo, Sri Lanka (CMB)");
                $("#departAirportText").val("Colombo, Sri Lanka (CMB)");
                $('#departAirportCode').val("CMB");
            }

            if ('' != '') {
                $("#flights .depart_date").datepicker("update", '');
                $("#flights .arrival_date").datepicker("update", '');

            }

            if ('' == 'ONE_WAY') {
                $("#owylinkId")[0].click();
            } else if ('' == 'RETURN') {
                $("#rtlinkId")[0].click();
            }

        }, 100);

    })(jQuery);
});

/** FLIGHTS SCRIPT :: ENDS */