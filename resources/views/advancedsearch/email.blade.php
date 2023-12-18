@extends('layouts.include-app')
@section('content-include')
    <section class="section">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form id="advancedEmail" method="post" action="{{ route('advancedsearch_email')}}">
                        <x-back-previous-url />
                        @csrf
                        <div class="buttons">
                            <a href="" id="resetButton" class="k-button">{{ __('content.reset')}}</a>
                            <input type="submit" class="k-button" id="submitAdvancedSearchEmail"
                                value="{{ __('content.search')}}" />
                        </div>
                        <div id="dataEmail" style="display: none;"></div>
                        <div id="dataOrganization" style="display: none;"></div>
                        <div id="dataMan" style="display: none;"></div>
                    </form>
                    <div style="clear: both;"></div>

                    <div id="tabstrip">
                        <ul>
                            <li class="k-state-active" id="emailAdv">{{ __('content.email')}}</li>
                            <li id="manAdv">{{ __('content.face')}}</li>
                            <li id="organizationAdv">{{ __('content.organization')}}</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <x-fullscreen-modal/>
@section('js-include')
    <script>
        var countAjax = 0;
        var realCount = 3;
        $(document).ready(function(e) {

            $('#tabstrip ul li').live('click', function() {
                $('#' + $(this).attr('id')).addClass('active_tab');
            });

            $("#tabstrip").kendoTabStrip({
                animation: {
                    open: {
                        effects: "fadeIn"
                    }
                },
                contentUrls: [
                    '/{{ app()->getLocale() }}/simplesearch/simple_search_email/1',
                     `/{{ app()->getLocale() }}/simplesearch/simple_search_man/1`,
                     `/{{ app()->getLocale() }}/simplesearch/simple_search_organization/1`,
                ]
            });


            $('#submitAdvancedSearchEmail').click(function(e) {
                e.preventDefault();
                countAjax = 0;
                $('#preloader').show();
                $('.redBack').removeClass('redBack');

                if (typeof $('#emailForm').attr('action') != 'undefined') {
                    if (formNotEmpty('emailForm')) {
                        var data = $('#emailForm').serializeArray();

                        $.ajax({
                            'url': '/{{ app()->getLocale() }}/simplesearch/result_email/1',
                            'type': 'POST',
                            'data': data,
                            'dataType': 'json',
                            'success': function(data) {
                                console.log(data)
                                if (data.status) {
                                console.log(data.status)

                                    $('#dataEmail').html('');
                                    $.each(data.data, function(key, value) {
                                        console.log(111)
                                        $('#dataEmail').append(
                                            '<input type="hidden" name="email[]" value="' +
                                            value.id + '"/>');
                                    });
                                    countEmail();
                                } else {
                                    $('#emailAdv').addClass('redBack');
                                    $('#preloader').hide();
                                    alert(`{{ __('content.email_found')}}`);
                                }
                            },
                            faild: function(data) {
                                alert(`{{ __('content.err')}} `);
                            }
                        });

                    } else {
                        countEmail();
                    }
                } else {
                    countEmail();
                }

                if (typeof $('#organizationForm').attr('action') != 'undefined') {
                    if (formNotEmpty('organizationForm')) {
                        var data = $('#organizationForm').serializeArray();
                        $.ajax({
                            'url': '/{{ app()->getLocale() }}/simplesearch/result_organization/1',
                            'type': 'POST',
                            'data': data,
                            'dataType': 'json',
                            'success': function(data) {
                                if (data.status) {
                                    $('#dataOrganization').html('');
                                    $.each(data.data, function(key, value) {
                                        $('#dataOrganization').append(
                                            '<input type="hidden" name="organization[]" value="' +
                                            value.id + '"/>');
                                    });
                                    countEmail()
                                } else {
                                    $('#organizationAdv').addClass('redBack');
                                    $('#preloader').hide();
                                    alert('О{{ __('content.organization_found')}}');
                                }
                            },
                            faild: function(data) {
                                alert('{{ __('content.err')}} ');
                            }
                        });
                    } else {
                        countEmail();
                    }
                } else {
                    countEmail();
                }

                if (typeof $('#manForm').attr('action') != 'undefined') {
                    if (formNotEmpty('manForm')) {
                        var data = $('#manForm').serializeArray();
                        $.ajax({
                            'url': '/{{ app()->getLocale() }}/simplesearch/result_man/1',
                            'type': 'POST',
                            'data': data,
                            'dataType': 'json',
                            'success': function(data) {
                                if (data.status) {
                                    $('#dataMan').html('');
                                    $.each(data.data, function(key, value) {
                                        $('#dataMan').append(
                                            '<input type="hidden" name="man[]" value="' +
                                            value.id + '"/>');
                                    });
                                    countEmail()
                                } else {
                                    $('#manAdv').addClass('redBack');
                                    $('#preloader').hide();
                                    alert('{{ __('content.face_found')}}');
                                }
                            },
                            faild: function(data) {
                                alert('{{ __('content.err')}} ');
                            }
                        });
                    } else {
                        countEmail();
                    }
                } else {
                    countEmail();
                }

            });


        });

        function countEmail() {
            countAjax++;
            if (countAjax == realCount) {
                $('#advancedEmail').submit();
            }
        }
    </script>
@endsection
@endsection
