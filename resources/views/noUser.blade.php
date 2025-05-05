@extends('layouts.shared')

@section('content')
<!-- Slider Start -->
<section class="banner">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-12 col-xl-7">
                <div class="block">
                    <div class="divider mb-3"></div>
                    <span class="text-uppercase text-sm letter-spacing" style="color: black;">Medical Tourism</span>
                    <h1 class="mb-3 mt-3" style="color: #26355D;">HealthNav</h1>
                    <p class="mb-4 pr-5" style="color: black;">Medical tourism is a person's trip abroad for the purpose
                        of
                        receiving health care, including general check-ups, treatment, and rehabilitation. In the health
                        industry, patients will be more likely to seek safe, comfortable, and quality services.</p>
                    <div class="d-flex">
                        <a href="/login" class="btn btn-danger mr-3">Learn More</a>
                        <a href="/login" class="btn btn-primary">Find Hospital</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Rest of the code remains unchanged until the MCU package buttons -->

<section class="features mt-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 style="color: #26355D; font-size: 3em; font-weight: bold; position: relative; display: inline-block; padding-bottom: 0.5em;">
                MCU Package Information
                    <span style="display: block; height: 5px; width: 100px; background-color: #0056b3; margin: 0.5em auto 0; border-radius: 5px;"></span>
                </h2>
                <p style="font-size: 1.2em; color: #555;">Choose a package that suits your health and travel needs</p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="feature-item text-center p-4" style="background-color: #f8d7da; border-radius: 20px; box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1); transition: all 0.3s ease; height: 100%;">
                    <!-- Content remains unchanged -->
                    <a href="/login" class="btn btn-danger" style="border-radius: 50px; padding: 10px 30px; font-weight: bold; transition: all 0.3s ease;">Harga: Rp 500.000</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="feature-item text-center p-4" style="background-color: #d4edda; border-radius: 20px; box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1); transition: all 0.3s ease; height: 100%;">
                    <!-- Content remains unchanged -->
                    <a href="/login" class="btn btn-success" style="border-radius: 50px; padding: 10px 30px; font-weight: bold; transition: all 0.3s ease;">Harga: Rp 1.000.000</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="feature-item text-center p-4" style="background-color: #cce5ff; border-radius: 20px; box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1); transition: all 0.3s ease; height: 100%;">
                    <!-- Content remains unchanged -->
                    <a href="/login" class="btn btn-primary" style="border-radius: 50px; padding: 10px 30px; font-weight: bold; transition: all 0.3s ease;">Harga: Rp 2.500.000</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Rest of the code remains unchanged until the registration form button -->

<section id="pendaftaran-mcu" class="section cta-page" style="padding: 60px 0; background-color: #f9f9f9;">
    <!-- Form content remains unchanged -->
    <button type="submit" class="btn btn-main btn-round-full" onclick="window.location.href='/login'"
        style="background-color: #003366; color: #fff; padding: 14px 28px; border-radius: 30px; font-size: 16px; transition: all 0.3s ease;">
        Register <i class="icofont-simple-right ml-2"></i>
    </button>
</section>

<!-- Rest of the code remains unchanged -->

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('form-pendaftaran-mcu');
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            window.location.href = '/login';
        }, false);
    });
</script>
@endsection