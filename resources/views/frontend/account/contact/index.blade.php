@extends('layouts.frontendmaster.master')

@section('content')
        <!-- breadcrumb start -->
    <div class="breadcrumb-section">
        <div class="container">
            <h2>Contact us</h2>
            <nav class="theme-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Contact us</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- breadcrumb End -->


    <!--contact section start-->
    <section class="contact-page">
        <div class="container">
            <div class="row g-sm-4 g-3">
                <div class="col-lg-5">
                    <div class="contact-title">
                        <h2>Get In Touch</h2>
                        <p>We're here to help! Reach out to us with any questions, feedback, or inquiries, and we'll get
                            back to you as soon as possible.</p>
                    </div>
                </div>
                <div class="col-lg-7">
                    <form action="{{ route('contact.store') }}"
                        method="POST"
                        class="theme-form contact-form">

                        @csrf

                        <div class="row g-4">
                        <div class="col-12">
                            <div class="form-box">
                                <label for="name" class="form-label">Full Name</label>

                                <input type="text"
                                    id="name"
                                    name="name"
                                    class="form-control"
                                    placeholder="Full Name"
                                    value="{{ old('name') }}">

                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-box">
                                <label for="email">Email</label>

                                <input type="email"
                                    id="email"
                                    name="email"
                                    class="form-control"
                                    placeholder="Email"
                                    value="{{ old('email') }}">

                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-box">
                                <label for="phone">Phone</label>

                                <input type="text"
                                    id="phone"
                                    name="phone"
                                    class="form-control"
                                    placeholder="Enter Your Phone Number"
                                    value="{{ old('phone') }}">

                                @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-box">
                                <label for="subject">Subject</label>

                                <input type="text"
                                    id="subject"
                                    name="subject"
                                    class="form-control"
                                    placeholder="Subject"
                                    value="{{ old('subject') }}">

                                @error('subject')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-box">
                                <label for="message">Write Your Message</label>

                                <textarea
                                    id="message"
                                    name="message"
                                    rows="6"
                                    class="form-control"
                                    placeholder="Write Your Message">{{ old('message') }}</textarea>

                                @error('message')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-box">

                                <button class="btn btn-solid"
                                    type="submit">

                                    Send Your Message

                                </button>

                            </div>
                        </div>
                        </div>
                    </form>
                </div>
                <div class="col-12">
                    <div class="contact-right">
                        <ul>
                            <li>
                                <div class="contact-icon">
                                    <i class="ri-phone-fill"></i>
                                </div>
                                <div class="media-body">
                                    <h6>Contact Us</h6>
                                    <p>+91 123 - 456 - 7890</p>
                                </div>
                            </li>
                            <li>
                                <div class="contact-icon">
                                    <i class="ri-map-pin-fill"></i>
                                </div>
                                <div class="media-body">
                                    <h6>Address</h6>
                                    <p>ABC Complex,Near xyz, New York</p>
                                </div>
                            </li>
                            <li>
                                <div class="contact-icon">
                                    <i class="ri-mail-fill"></i>
                                </div>
                                <div class="media-body">
                                    <h6>Email</h6>
                                    <p>support@multikart.com</p>
                                </div>
                            </li>
                            <li>
                                <div class="contact-icon">
                                    <i class="ri-cellphone-fill"></i>
                                </div>
                                <div class="media-body">
                                    <h6>Fax</h6>
                                    <p>support@multikart.com</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--contact section ends-->


    <!-- map section start -->
    <section class="map-section">
        <iframe frameborder="0" class="w-100 h-100"
            src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d1605.811957341231!2d25.45976406005396!3d36.3940974010114!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1550912388321"></iframe>
    </section>
    <!-- map section End -->

@endsection