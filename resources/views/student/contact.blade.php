@extends('student.layout')

@section('title', 'Contact Us')

@section('content')
<div style="padding: 40px 60px; min-height: 70vh;">

    {{-- BREADCRUMB --}}
    <nav style="font-size: 13px; color: #888; margin-bottom: 30px;">
        <a href="{{ route('homepage') }}" style="color: #025628; text-decoration: none;">Home</a>
        <span style="margin: 0 8px;">/</span>
        <span>Contact</span>
    </nav>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div style="background: #e8f5e9; color: #025628; padding: 14px 20px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #025628;">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    {{-- CONTACT SECTION --}}
    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 40px; background: white; border: 1px solid #eee; border-radius: 12px; padding: 40px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">

        {{-- LEFT - CONTACT INFO --}}
        <div style="display: flex; flex-direction: column; gap: 30px;">

            {{-- Call Us --}}
            <div style="display: flex; gap: 16px; align-items: flex-start;">
                <div style="width: 50px; height: 50px; background: #025628; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <i class="fas fa-phone" style="color: white; font-size: 18px;"></i>
                </div>
                <div>
                    <h4 style="font-size: 16px; font-weight: 700; color: #1a1a1a; margin-bottom: 6px;">Call To Us</h4>
                    <p style="font-size: 13px; color: #888; line-height: 1.6; margin-bottom: 6px;">We are available 24/7, 7 days a week.</p>
                    <p style="font-size: 13px; color: #444;">Phone: +88015-88888-9999</p>
                </div>
            </div>

            <hr style="border: none; border-top: 1px solid #eee;">

            {{-- Write To Us --}}
            <div style="display: flex; gap: 16px; align-items: flex-start;">
                <div style="width: 50px; height: 50px; background: #025628; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <i class="fas fa-envelope" style="color: white; font-size: 18px;"></i>
                </div>
                <div>
                    <h4 style="font-size: 16px; font-weight: 700; color: #1a1a1a; margin-bottom: 6px;">Write To Us</h4>
                    <p style="font-size: 13px; color: #888; line-height: 1.6; margin-bottom: 6px;">Fill out our form and we will contact you within 24 hours.</p>
                    <p style="font-size: 13px; color: #444;">Emails: Regals@gmail.com</p>
                    <p style="font-size: 13px; color: #444;">Emails: support@ledipo.gov.ph</p>
                </div>
            </div>

            <hr style="border: none; border-top: 1px solid #eee;">

            {{-- Address --}}
            <div style="display: flex; gap: 16px; align-items: flex-start;">
                <div style="width: 50px; height: 50px; background: #025628; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <i class="fas fa-location-dot" style="color: white; font-size: 18px;"></i>
                </div>
                <div>
                    <h4 style="font-size: 16px; font-weight: 700; color: #1a1a1a; margin-bottom: 6px;">Visit Us</h4>
                    <p style="font-size: 13px; color: #888; line-height: 1.6; margin-bottom: 6px;">Come visit us at our office.</p>
                    <p style="font-size: 13px; color: #444;">Barangay Burol Main, City of Dasmariñas, Cavite, Philippines.</p>
                </div>
            </div>

        </div>

        {{-- RIGHT - CONTACT FORM --}}
        <div>
            <form action="{{ route('contact.send') }}" method="POST">
                @csrf

                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                    <div>
                        <input type="text" name="name" placeholder="Your Name *"
                            style="width: 100%; padding: 14px 16px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; outline: none; font-family: inherit;"
                            required>
                    </div>
                    <div>
                        <input type="email" name="email" placeholder="Your Email *"
                            style="width: 100%; padding: 14px 16px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; outline: none; font-family: inherit;"
                            required>
                    </div>
                    <div>
                        <input type="text" name="phone" placeholder="Your Phone *"
                            style="width: 100%; padding: 14px 16px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; outline: none; font-family: inherit;">
                    </div>
                </div>

                <div style="margin-bottom: 20px;">
                    <textarea name="message" placeholder="Your Message"
                        style="width: 100%; padding: 14px 16px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; outline: none; font-family: inherit; height: 180px; resize: vertical;"
                        required></textarea>
                </div>

                <div style="text-align: right;">
                    <button type="submit"
                        style="background: #025628; color: white; border: none; padding: 14px 36px; border-radius: 6px; font-size: 15px; font-weight: 600; cursor: pointer; font-family: inherit; transition: background 0.3s;">
                        Send Message
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection