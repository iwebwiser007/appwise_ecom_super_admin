@extends('components.front.layouts')
@section('content')
<section class="contact_page_section">
    <div class="container">
        <div class="contact_inner">
            <div class="contact_form">
            @if (Session::has('success_message'))
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                    <strong>Success:</strong> {{ Session::get('success_message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="section_title">
                    <h2>Leave a <span>message</span></h2>
                    <p>Fill up form below, our team will get back soon</p>
                </div>

              
                <form action="" >
                    @csrf
                    <div class="form-group">
                        <input type="text" placeholder="Name" name="name" id="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="email" placeholder="Email" name="email" id="email" class="form-control">
                    </div>
                    <!-- <div class="form-group">
                        <input type="text" placeholder="Company Name" class="form-control">
                    </div>
                    <div class="form-group">
                        <select class="form-control">
                            <option value="">Country</option>
                        </select>
                    </div> -->
                    <div class="form-group">
                        <input type="text" placeholder="Phone" name="phone" id="phone" class="form-control">
                    </div>
                    <!-- <div class="form-group">
                        <input type="text" placeholder="Website" class="form-control">
                    </div> -->
                    <div class="form-group">
                        <input type="text" placeholder="Address" name="address" id="address" class="form-control">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="message" id="message" placeholder="Your message"></textarea>
                    </div>
                    {{--<div class="form-group term_check">
                        <input type="checkbox" id="term">
                        <label for="term">I agree to receive emails, newsletters and promotional messages</label>
                    </div>--}}
                    <div class="form-group mb-0">
                        <button type="submit" class="btn puprple_btn">SEND MESSAGE</button>
                    </div>
                </form>
            </div>
            <div class="contact_info">
                <div class="icon"><img src="http://localhost/appwise_ecom_super_admin/public/front/images/contact_message_icon.png" alt="image"></div>
                <div class="section_title">
                    <h2>Have any <span>question?</span></h2>
                    <p>If you have any question about our product, service, payment or company, Visit our <a href="faq.html">FAQs
                            page.</a></p>
                </div>
                <a href="faq.html" class="btn puprple_btn">READ FAQ</a>
                <ul class="contact_info_list">
                    <li>
                        <div class="img">
                            <img src="http://localhost/appwise_ecom_super_admin/public/front/images/mail_icon.png" alt="image">
                        </div>
                        <div class="text">
                            <span>Email Us</span>
                            <a href="mailto:example@gmail.com">example@gmail.com</a>
                        </div>
                    </li>
                    <li>
                        <div class="img">
                            <img src="http://localhost/appwise_ecom_super_admin/public/front/images/call_icon.png" alt="image">
                        </div>
                        <div class="text">
                            <span>Call Us</span>
                            <a href="tel:+1(888)553-46-11">+1 (888) 553-46-11</a>
                        </div>
                    </li>
                    <li>
                        <div class="img">
                            <img src="http://localhost/appwise_ecom_super_admin/public/front/images/location_icon.png" alt="image">
                        </div>
                        <div class="text">
                            <span>Visit Us</span>
                            <p>5687, Business Avenue, New York, USA 5687</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection
