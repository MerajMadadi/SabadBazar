@extends('layouts.app')
@section('content')
    <!--شروع برگه-->
    <section class="contact-us rt-page rt-relative rt-overflow rt">
        <div class="main">
            <article class="entery rt rt-10px rt-bg rt-relative rt-shadow rt-z-index rt-overflow">
                <div class="gr-form left rt-bg rt-shadow rt-15px">
                    <h1 class="title rt rt-dana rt-444 rt-align rt-bold rt-18" style="margin-bottom:10px">تماس با سبدبازار</h1>
                    <div class="gf_browser_gecko gform_wrapper" id="gform_wrapper_2">
                        <form method="post" enctype="multipart/form-data" id="gform_2" action="#">
                            <div class="gform_body">
                                <ul id="gform_fields_2" class="gform_fields top_label form_sublabel_below description_below">
                                    <li id="field_2_1" class="gfield gfield_contains_required field_sublabel_below field_description_below gfield_visibility_visible">
                                        <label class="gfield_label" for="input_2_1">نام و نام خانوادگی<span class="gfield_required">*</span></label>
                                        <div class="ginput_container ginput_container_text"><input name="input_1" id="input_2_1" type="text" value="" class="medium" aria-required="true" aria-invalid="false" /></div>
                                    </li>
                                    <li id="field_2_4" class="gfield gfield_contains_required field_sublabel_below field_description_below gfield_visibility_visible">
                                        <label class="gfield_label" for="input_2_4">موضوع پیام<span class="gfield_required">*</span></label>
                                        <div class="ginput_container ginput_container_text"><input name="input_4" id="input_2_4" type="text" value="" class="medium" aria-required="true" aria-invalid="false" /></div>
                                    </li>
                                    <li id="field_2_5" class="gfield gfield_contains_required field_sublabel_below field_description_below gfield_visibility_visible">
                                        <label class="gfield_label" for="input_2_5">متن پیام<span class="gfield_required">*</span></label>
                                        <div class="ginput_container ginput_container_textarea"><textarea name="input_5" id="input_2_5" class="textarea medium" aria-required="true" aria-invalid="false" rows="10" cols="50"></textarea></div>
                                    </li>
                                    <li id="field_2_6" class="gfield field_sublabel_below field_description_below gfield_visibility_visible">
                                        <label class="gfield_label" for="input_2_6">نحوه اطلاع رسانی و ارسال پاسخ به شما</label>
                                        <div class="ginput_container ginput_container_select">
                                            <select name="input_6" id="input_2_6" class="medium gfield_select" aria-invalid="false">
                                                <option value="تلفنی">تلفنی</option>
                                                <option value="پیامک">پیامک</option>
                                                <option value="ایمیل">ایمیل</option>
                                                <option value="تلگرام">تلگرام</option>
                                            </select>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="gform_footer top_label">
                                <input type="submit" class="gform_button button" value="ارسال"/>
                            </div>

                            </p>
                        </form>
                    </div>

                </div>
                <ul class="list right">

                    <li class="rt">
                        <div class="ins right">
                            <span class="tit rt rt-16 rt-medium rt-dana rt-444">ساعات کاری</span>
                            <span class="desc rt rt-14 rt-888">شنبه تا چهارشنبه ۹ الی ۱۷ و پنجشنبه ۹ الی ۱۲</span>
                        </div>
                    </li>

                    <li class="rt">
                        <svg class="icon right" xmlns="http://www.w3.org/2000/svg" width="37" height="36" viewBox="0 0 37 36"><path fill="#aab1c3" d="M8.22 18.162c-1.242-2.445-1.872-4.472-1.872-6.029-.003-1.63.322-3.245.956-4.746 2.615-6.2 9.755-9.106 15.95-6.49a.61.61 0 0 1-.475 1.121 11.012 11.012 0 0 0-8.523 0 10.986 10.986 0 0 0-6.691 10.115c0 1.363.584 3.205 1.74 5.473a52.332 52.332 0 0 0 3.927 6.333 98.608 98.608 0 0 0 4.82 6.231.616.616 0 0 0 .926 0 99.084 99.084 0 0 0 4.82-6.23 52.321 52.321 0 0 0 3.927-6.334c1.155-2.268 1.74-4.11 1.74-5.473a10.963 10.963 0 0 0-3.207-7.763.61.61 0 1 1 .86-.86 12.177 12.177 0 0 1 3.564 8.623c0 1.557-.63 3.584-1.873 6.026a53.532 53.532 0 0 1-4.019 6.484 100.169 100.169 0 0 1-4.41 5.743h3.001a.608.608 0 0 1 0 1.217h-9.733a.608.608 0 0 1 0-1.217h3.002c-.132-.16-.268-.324-.412-.502a101.251 101.251 0 0 1-3.999-5.241 53.467 53.467 0 0 1-4.019-6.481zm5.522-7.604a4.873 4.873 0 0 0 2.91 5.451c2.146.89 4.62.138 5.91-1.794a4.875 4.875 0 0 0-.606-6.152.61.61 0 1 1 .86-.86 6.094 6.094 0 0 1 .757 7.688 6.08 6.08 0 0 1-7.387 2.243 6.09 6.09 0 0 1 2.329-11.716.609.609 0 0 1 0 1.218 4.868 4.868 0 0 0-4.773 3.922zm22.775 24.384c-.34.58-.966.932-1.638.924H2.15a1.873 1.873 0 0 1-1.638-.924 1.767 1.767 0 0 1-.019-1.773l3.74-6.698a1.892 1.892 0 0 1 1.657-.957h4.336a.609.609 0 0 1 0 1.218H5.89a.674.674 0 0 0-.594.332l-3.74 6.699c-.101.174-.1.39.006.562a.67.67 0 0 0 .588.323h32.73a.67.67 0 0 0 .588-.323.548.548 0 0 0 .006-.562l-3.74-6.699a.675.675 0 0 0-.595-.332h-4.336a.609.609 0 0 1 0-1.218h4.336a1.89 1.89 0 0 1 1.655.957l3.742 6.698a1.767 1.767 0 0 1-.02 1.773zm-5.835-5.774a.609.609 0 0 1-.609.609h-2.25l-1.67 1.116a.608.608 0 1 1-.676-1.014l1.825-1.218a.61.61 0 0 1 .338-.102h2.433c.336 0 .609.272.609.609zm-3.65 3.044h4.866a.609.609 0 0 1 0 1.218h-4.866a.609.609 0 0 1 0-1.218zm-16.153-1.32l-1.672-1.115H6.956a.609.609 0 0 1 0-1.218h2.433c.12 0 .238.035.339.102l1.825 1.218a.61.61 0 0 1-.674 1.013zm-.881 1.32a.609.609 0 0 1 0 1.218H5.13a.609.609 0 0 1 0-1.218z"></path></svg>
                        <div class="ins left">
                            <span class="tit rt rt-16 rt-medium rt-dana rt-444">آدرس</span>
                            <span class="desc rt rt-14 rt-888">  ساوه،مرزداران،ساختمان ایرانیان</span>
                        </div>
                    </li>

                    <li class="rt">
                        <svg class="icon right" xmlns="http://www.w3.org/2000/svg" width="38" height="38" viewBox="0 0 38 38"><path fill="#aab1c3" d="M37.002 31.705l-1.86 3.089a4.358 4.358 0 0 1-2.58 1.988c-.933.253-1.895.378-2.861.374a14.991 14.991 0 0 1-5.045-.946 17.97 17.97 0 0 1-5.54.873C9.077 37.07.943 28.935.934 18.897a.609.609 0 1 1 1.217 0A16.925 16.925 0 0 0 8.493 32.15a16.934 16.934 0 0 0 14.319 3.302c-3.266-1.522-7.129-4.212-11.622-8.704C.877 16.435.04 9.435 1.153 5.38A4.36 4.36 0 0 1 3.14 2.8L6.233.941a2.147 2.147 0 0 1 2.894.651l4.931 7.393c.62.938.416 2.195-.47 2.89l-2.767 2.152a.921.921 0 0 0-.244 1.184l.225.41c.74 1.355 1.664 3.046 5.069 6.451 3.404 3.406 5.094 4.327 6.453 5.067l.41.226c.4.222.903.116 1.18-.248l2.151-2.769a2.16 2.16 0 0 1 2.89-.47l4.96 3.307a16.952 16.952 0 0 0-.153-16.873 16.96 16.96 0 0 0-14.645-8.385.609.609 0 1 1 0-1.217 18.176 18.176 0 0 1 15.721 9.027 18.169 18.169 0 0 1 .094 18.127l1.42.945a2.146 2.146 0 0 1 .65 2.895zm-1.331-1.88l-7.394-4.93a.937.937 0 0 0-1.254.203l-2.153 2.767a2.131 2.131 0 0 1-2.734.564l-.4-.22c-1.427-.778-3.201-1.745-6.733-5.275-3.531-3.53-4.498-5.305-5.276-6.731l-.22-.4a2.13 2.13 0 0 1 .564-2.734l2.768-2.152a.937.937 0 0 0 .203-1.254L10.794 6.29l-2.678-4.02a.932.932 0 0 0-1.256-.283L3.768 3.843a3.152 3.152 0 0 0-1.441 1.859c-1.028 3.745-.175 10.287 9.723 20.183 5.142 5.139 9.375 7.836 12.784 9.101a.607.607 0 0 1 .156.061c3.082 1.11 5.48 1.05 7.251.563a3.146 3.146 0 0 0 1.86-1.44l1.855-3.092a.93.93 0 0 0-.285-1.254z"></path></svg>
                        <div class="ins left">
                            <span class="tit rt rt-16 rt-medium rt-dana rt-444">تلفن تماس</span>
                            <span class="desc rt rt-22 rt-bold rt-rang"><span class="rt-15 rt-888">۰۸۶</span>۲۲۲۲۲۲۲۲</span>
                        </div>
                    </li>

                    <li class="rt">
                        <svg class="icon right" xmlns="http://www.w3.org/2000/svg" width="37" height="38" viewBox="0 0 37 38"><path fill="#aab1c3" d="M36.777 14.626v20.707c-.003.196-.037.39-.101.576a.604.604 0 0 1-.508.934.593.593 0 0 1-.16-.026 1.814 1.814 0 0 1-1.058.343H2.076c-.378 0-.747-.118-1.054-.338a.604.604 0 0 1-.67-.913c-.065-.186-.1-.38-.101-.576v-20.71c0-.013.007-.023.007-.035a.578.578 0 0 1 .025-.123.59.59 0 0 1 .034-.105.574.574 0 0 1 .061-.091.593.593 0 0 1 .083-.097c.01-.008.014-.02.024-.027l5.853-4.55V4.882c0-1.009.817-1.827 1.826-1.827h6.597l2.642-2.052a1.805 1.805 0 0 1 2.22 0l2.642 2.052h6.597c1.01 0 1.827.818 1.827 1.827v4.715l5.853 4.549c.01.008.014.02.024.028.03.029.059.06.083.096a.572.572 0 0 1 .06.091.63.63 0 0 1 .035.105c.013.04.021.083.025.125 0 .012.008.023.008.036zM16.747 3.054h3.532l-1.405-1.09a.584.584 0 0 0-.726 0zM34.8 35.942L18.874 23.57a.585.585 0 0 0-.726 0L2.228 35.942zm.76-20.389l-9.994 7.764a.61.61 0 0 1-.747-.963l10.153-7.887-4.282-3.33v4.707a.609.609 0 1 1-1.218 0V4.88a.609.609 0 0 0-.609-.609H8.164a.609.609 0 0 0-.609.609v10.963a.609.609 0 1 1-1.217 0v-4.706l-4.283 3.329L12.19 22.34a.609.609 0 0 1-.747.963l-9.976-7.75v19.438l15.937-12.383a1.805 1.805 0 0 1 2.218 0L35.56 34.991zM11.817 7.926c0-.336.272-.609.608-.609h12.176a.609.609 0 1 1 0 1.219H12.425a.609.609 0 0 1-.608-.61zM24.6 12.19H12.425a.609.609 0 1 1 0-1.218h12.176a.609.609 0 1 1 0 1.218zm0 3.654h-5.479a.61.61 0 0 1 0-1.218h5.479a.609.609 0 0 1 0 1.218z"></path></svg>
                        <div class="ins left">
                            <span class="tit rt rt-16 rt-medium rt-dana rt-444">ایمیل پشتیبانی</span>
                            <span class="desc rt rt-14"><a href="#" class="rt-bold rt-444">noreplay@Site.com</a></span>
                        </div>
                    </li>

                    <iframe class="rt rt-10px" src="https://balad.ir/embed?p=P8wQf1KDXh1nEM" height="260" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

                </ul>
            </article>
        </div>
    </section>
    <!--پایان برگه-->
@endsection
