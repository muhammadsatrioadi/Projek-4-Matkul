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
                        <a href="/about" class="btn btn-danger mr-3">Learn More</a>
                        <a href="/selection-hospital" class="btn btn-primary">Find Hospital</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Informasi Paket MCU -->
<style>
    /* Custom Scrollbar Styles */
    .custom-scrollbar {
        scrollbar-width: thin;
        scrollbar-color: transparent transparent;
        transition: scrollbar-color 0.3s ease;
    }

    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: transparent;
        border-radius: 10px;
    }

    .custom-scrollbar:hover {
        scrollbar-color: rgba(0,0,0,0.2) transparent;
    }

    .custom-scrollbar:hover::-webkit-scrollbar-thumb {
        background: rgba(0,0,0,0.2);
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: rgba(0,0,0,0.4);
    }

    /* Smooth scroll behavior */
    .custom-scrollbar {
        scroll-behavior: smooth;
    }
</style>

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
                    <div class="feature-icon mb-3">
                        <i class="fas fa-heartbeat" style="font-size: 48px; color: #dc3545;"></i>
                    </div>
                    <h4 class="mb-3" style="color: #ffffff; font-weight: bold;">Basic MCU</h4>
                    <p class="mb-4 custom-scrollbar" style="color: #ffffff; height: 120px; overflow-y: auto; padding: 0 10px;">The Basic Medical Check-Up Package includes essential health assessments, such as measuring blood pressure and conducting basic blood tests. It also includes a general physical examination to evaluate your health.</p>
                    <div style="margin: 20px 0; padding: 15px; background-color: rgba(255,255,255,0.3); border-radius: 15px;">
                        <h5 style="color: #721c24; font-weight: bold;">Excursions Included:</h5>
                        <ul style="color: #721c24; text-align: left; padding-left: 20px;">
                            <li>Bukit Paralayang</li>
                            <li>Malioboro</li>
                        </ul>
                    </div>
                    <a href="{{ url('about#basic-mcu') }}" class="btn btn-danger" style="border-radius: 50px; padding: 10px 30px; font-weight: bold; transition: all 0.3s ease;">Harga: Rp 500.000</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="feature-item text-center p-4" style="background-color: #d4edda; border-radius: 20px; box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1); transition: all 0.3s ease; height: 100%;">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-stethoscope" style="font-size: 48px; color: #28a745;"></i>
                    </div>
                    <h4 class="mb-3" style="color: #ffffff; font-weight: bold;">Standard MCU</h4>
                    <p class="mb-4 custom-scrollbar" style="color: #ffffff; height: 120px; overflow-y: auto; padding: 0 10px;">The Standard Medical Check-Up package includes all the assessments in the Basic package, plus additional comprehensive tests. These include measuring cholesterol levels and conducting an EKG. More detailed blood tests are also included.</p>
                    <div style="margin: 20px 0; padding: 15px; background-color: rgba(255,255,255,0.3); border-radius: 15px;">
                        <h5 style="color: #155724; font-weight: bold;">Excursions Included:</h5>
                        <ul style="color: #155724; text-align: left; padding-left: 20px;">
                            <li>Bukit Paralayang</li>
                            <li>Malioboro</li>
                            <li>Candi Prambanan</li>
                        </ul>
                    </div>
                    <a href="{{ url('about#standard-mcu') }}" class="btn btn-success" style="border-radius: 50px; padding: 10px 30px; font-weight: bold; transition: all 0.3s ease;">Harga: Rp 1.000.000</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="feature-item text-center p-4" style="background-color: #cce5ff; border-radius: 20px; box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1); transition: all 0.3s ease; height: 100%;">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-user-md" style="font-size: 48px; color: #007bff;"></i>
                    </div>
                    <h4 class="mb-3" style="color: #ffffff; font-weight: bold;">Premium MCU</h4>
                    <p class="mb-4 custom-scrollbar" style="color: #ffffff; height: 120px; overflow-y: auto; padding: 0 10px;">The Premium Medical Check-Up package offers the most comprehensive health assessment, including all tests from the Basic and Standard packages, as well as advanced imaging tests such as MRI, CT scan, and detailed consultations with specialists.</p>
                    <div style="margin: 20px 0; padding: 15px; background-color: rgba(255,255,255,0.3); border-radius: 15px;">
                        <h5 style="color: #004085; font-weight: bold;">Excursions Included:</h5>
                        <ul style="color: #004085; text-align: left; padding-left: 20px;">
                            <li>Bukit Paralayang</li>
                            <li>Malioboro</li>
                            <li>Candi Prambanan</li>
                            <li>Candi Borobudur</li>
                            <li>Pantai Parangtritis</li>
                        </ul>
                    </div>
                    <a href="{{ url('about#premium-mcu') }}" class="btn btn-primary" style="border-radius: 50px; padding: 10px 30px; font-weight: bold; transition: all 0.3s ease;">Harga: Rp 2.500.000</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Informasi Paket MCU -->

<!-- Pendaftaran MCU Section -->
<section id="pendaftaran-mcu" class="section cta-page" style="padding: 60px 0; background-color: #f9f9f9;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="cta-content" style="padding: 20px; background-color: #6F8BA4;">
                    <h2 class="title-color"
                        style="font-family: 'Arial', sans-serif; color: #333; font-size: 36px; line-height: 1.4; margin-bottom: 20px;">
                        Register for <br>Medical Check-Up for Tourists
                    </h2>
                    <p class="lead" style="color: #fffff; font-size: 18px; margin-bottom: 30px;">
                        Take care of your health while traveling in Indonesia by doing a medical check-up. Fill out the
                        following form to register.
                    </p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-wrapper"
                    style="padding: 30px; border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); background: linear-gradient(to right, #f0f8ff, #e0f7fa);">
                    <div class="form-header"
                        style="background-color: #003366; color: #fff; padding: 10px 20px; border-radius: 15px 15px 0 0; font-size: 18px;">
                        Registration Form
                    </div>
                    <form id="form-pendaftaran-mcu" class="appoinment-form" method="post"
                        action="{{ route('submit-registration') }}" style="padding: 20px;">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Full name</label>
                                    <input name="name" id="name" type="text" class="form-control"
                                        placeholder="Full name" required
                                        style="border: 2px solid #003366; padding: 12px; border-radius: 10px; transition: all 0.3s ease;">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="phone">Phone number</label>
                                    <input name="phone" id="phone" type="tel" class="form-control"
                                        placeholder="Phone number" required
                                        style="border: 2px solid #003366; padding: 12px; border-radius: 10px; transition: all 0.3s ease;">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input name="email" id="email" type="email" class="form-control" placeholder="Email"
                                        required
                                        style="border: 2px solid #003366; padding: 12px; border-radius: 10px; transition: all 0.3s ease;">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="birthdate">Date of birth</label>
                                    <input name="birthdate" id="birthdate" type="date" class="form-control"
                                        placeholder="Date of birth" required
                                        style="border: 2px solid #003366; padding: 12px; border-radius: 10px; transition: all 0.3s ease;">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="passport">Passport number</label>
                                    <input name="passport" id="passport" type="text" class="form-control"
                                        placeholder="Passport number" required
                                        style="border: 2px solid #003366; padding: 12px; border-radius: 10px; transition: all 0.3s ease;">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="address">Address in Indonesia</label>
                                    <input name="address" id="address" type="text" class="form-control"
                                        placeholder="Address in Indonesia" required
                                        style="border: 2px solid #003366; padding: 12px; border-radius: 10px; transition: all 0.3s ease;">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="reservation_date">Reservation Date</label>
                                    <input name="reservation_date" id="reservation_date" type="date"
                                        class="form-control" placeholder="Reservation Date" required
                                        style="border: 2px solid #003366; padding: 12px; border-radius: 10px; transition: all 0.3s ease;">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="time">Select Time</label>
                                    <select class="form-control" name="time" id="time" required
                                        style="border: 2px solid #003366; padding: 12px; border-radius: 10px; transition: all 0.3s ease;">
                                        <option value="" disabled selected>Select Time</option>
                                        <option value="09.00 AM">09.00 AM</option>
                                        <option value="13.00 PM">13.00 PM</option>
                                        <option value="16.00 PM">16.00 PM</option>
                                        <option value="20.00 PM">20.00 PM</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="package">Select MCU Package</label>
                                    <select class="form-control" name="package" id="package" required
                                        style="border: 2px solid #003366; padding: 12px; border-radius: 10px; transition: all 0.3s ease;">
                                        <option value="" disabled selected>Select MCU Package</option>
                                        <option value="basic">Basic</option>
                                        <option value="standard">Standard</option>
                                        <option value="premium">Premium</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div id="tourist-attractions" style="display: none; margin-top: 20px; padding: 15px; background-color: #e0f7fa; border-radius: 10px;">
                                    <h4 style="color: #003366; margin-bottom: 10px;">Tourist Attractions Included:</h4>
                                    <ul id="attractions-list" style="list-style-type: disc; padding-left: 20px;"></ul>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="destination" id="destination"> <!-- Hidden input field for destination -->
                        <div class="form-group-2 mb-4">
                            <label for="notes">Additional Notes (optional)</label>
                            <textarea name="notes" id="notes" class="form-control" rows="6"
                                placeholder="Additional Notes (optional)"
                                style="border: 2px solid #003366; padding: 12px; border-radius: 10px; transition: all 0.3s ease;"></textarea>
                        </div>
                        <button type="submit" class="btn btn-main btn-round-full"
                            style="background-color: #003366; color: #fff; padding: 14px 28px; border-radius: 30px; font-size: 16px; transition: all 0.3s ease;">
                            Register <i class="icofont-simple-right ml-2"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Pendaftaran MCU Section -->

<script>
document.addEventListener('DOMContentLoaded', function() {
    const packageSelect = document.getElementById('package');
    const touristAttractions = document.getElementById('tourist-attractions');
    const attractionsList = document.getElementById('attractions-list');
    const destinationInput = document.getElementById('destination'); // Hidden input field

    packageSelect.addEventListener('change', function() {
        const selectedPackage = packageSelect.value;

        // Clear the attractions list
        attractionsList.innerHTML = '';

        // Show relevant attractions based on selected package
        let attractions = [];
        let destination = '';
        if (selectedPackage === 'basic') {
            destination = 'Destination Basic'; // Example value
            attractions = ['Bukit Paralayang', 'Malioboro'];
        } else if (selectedPackage === 'standard') {
            destination = 'Destination Standard'; // Example value
            attractions = ['Bukit Paralayang', 'Malioboro', 'Candi Prambanan'];
        } else if (selectedPackage === 'premium') {
            destination = 'Destination Premium'; // Example value
            attractions = ['Bukit Paralayang', 'Malioboro', 'Candi Prambanan', 'Candi Borobudur', 'Pantai Parangtritis'];
        } else {
            destination = ''; // Reset if no package selected
        }

        // Update the destination input field
        destinationInput.value = destination;

        // Populate the attractions list
        if (attractions.length > 0) {
            attractions.forEach(function(attraction) {
                const listItem = document.createElement('li');
                listItem.textContent = attraction;
                attractionsList.appendChild(listItem);
            });
            touristAttractions.style.display = 'block';
        } else {
            touristAttractions.style.display = 'none';
        }
    });
});
</script>


<!-- Testimonials Section -->
<section class="section testimonial-2 gray-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="section-title text-center">
                    <h2 class="font-weight-bold" style="color: #26355D;">We served over 1000+ Patients</h2>
                    <div class="divider mx-auto my-4"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12 testimonial-wrap-2 d-flex flex-wrap justify-content-between">
                <div class="testimonial-block style-2 gray-bg p-4 mb-4"
                    style="flex: 0 0 32%; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    <i class="icofont-quote-right" style="font-size: 24px; color: #6c757d;"></i>
                    <div class="testimonial-thumb my-3">
                        <img src="assets/images/team/rara.jpg" alt="Dara Amanda" class="img-fluid rounded-circle">
                    </div>
                    <div class="client-info">
                        <h4 class="font-weight-bold">Dara Amanda</h4>
                        <span class="text-muted">Lampung</span>
                        <p class="mt-3">HealthNav your travel companion for the best healthcare abroad! They have a
                            safe, comfortable and quality service network. So, you can calm down and focus on recovery
                            without worrying.</p>
                    </div>
                </div>

                <div class="testimonial-block style-2 gray-bg p-4 mb-4"
                    style="flex: 0 0 32%; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    <div class="testimonial-thumb my-3">
                        <img src="assets/images/team/iqbaal.jpg" alt="Iqbaal Ramadhan" class="img-fluid rounded-circle">
                    </div>
                    <div class="client-info">
                        <h4 class="font-weight-bold">Iqbaal Ramadhan</h4>
                        <span class="text-muted">Sleman</span>
                        <p class="mt-3">HealthNav has really helped my health journey! I felt safe, comfortable and
                            received quality care abroad. Highly recommended for anyone seeking international medical
                            services.</p>
                    </div>
                </div>

                <div class="testimonial-block style-2 gray-bg p-4 mb-4"
                    style="flex: 0 0 32%; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    <div class="testimonial-thumb my-3">
                        <img src="assets/images/team/kikow.jpg" alt="Ahmad Sholis" class="img-fluid rounded-circle">
                    </div>
                    <div class="client-info">
                        <h4 class="font-weight-bold">kikoww</h4>
                        <span class="text-muted">Gresik</span>
                        <p class="mt-3">With HealthNav, my medical travel has become very easy and safe. They offer
                            high-quality service with the utmost comfort, making me feel at ease throughout the
                            treatment process. Amazing service!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Chatbot Widget -->
<style>
.chatbot-widget {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 1000;
}

.chat-messages {
    padding: 15px;
}

.message {
    margin-bottom: 15px;
    padding: 10px 15px;
    border-radius: 15px;
    max-width: 80%;
}

.bot-message {
    background-color: #f0f2f5;
    margin-right: auto;
}

.user-message {
    background-color: #0d6efd;
    color: white;
    margin-left: auto;
}

.typing-indicator {
    display: none;
    padding: 10px 15px;
    background-color: #f0f2f5;
    border-radius: 15px;
    margin-bottom: 15px;
    width: fit-content;
}

.typing-indicator span {
    display: inline-block;
    width: 8px;
    height: 8px;
    background-color: #90949c;
    border-radius: 50%;
    margin-right: 5px;
    animation: typing 1s infinite;
}

.typing-indicator span:nth-child(2) { animation-delay: 0.2s; }
.typing-indicator span:nth-child(3) { animation-delay: 0.4s; }

@keyframes typing {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-5px); }
}
</style>

<div class="chatbot-widget">
    <button class="btn btn-primary rounded-circle p-3 shadow" data-bs-toggle="modal" data-bs-target="#chatbotModal">
        <i class="fas fa-comments fs-4"></i>
    </button>
</div>

<!-- Chatbot Modal -->
<div class="modal fade" id="chatbotModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Bot Avatar" class="rounded-circle me-2" width="40">
                    <div>
                        <h5 class="modal-title mb-0"><i class="fas fa-robot"></i> HealthNav Assistant</h5>
                        <small><i class="fas fa-circle text-success"></i> Online</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" style="height: 400px; overflow-y: auto;">
                <div class="chat-messages">
                    <div class="message bot-message">
                        <i class="fas fa-robot"></i> Halo! Saya asisten virtual HealthNav. Ada yang bisa saya bantu?
                    </div>
                    <div class="message bot-message">
                        <i class="fas fa-info-circle"></i> Saya dapat membantu Anda dengan:
                        <ul>
                            <li><i class="fas fa-hospital"></i> Informasi paket MCU</li>
                            <li><i class="fas fa-calendar-check"></i> Jadwal pemeriksaan</li>
                            <li><i class="fas fa-user-plus"></i> Pendaftaran MCU</li>
                            <li><i class="fas fa-map-marker-alt"></i> Lokasi rumah sakit</li>
                            <li><i class="fas fa-plane-departure"></i> Informasi wisata</li>
                        </ul>
                    </div>
                    <div class="typing-indicator">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="input-group">
                    <input type="text" id="chatInput" class="form-control" placeholder="Ketik pesan Anda...">
                    <button class="btn btn-primary" onclick="sendMessage()">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const responses = {
    'halo': 'Halo! Ada yang bisa saya bantu?',
    'hi': 'Hi! Bagaimana saya bisa membantu Anda?',
    'paket': 'Kami menyediakan 3 paket MCU:\n1. Basic MCU (Rp 500.000)\n2. Standard MCU (Rp 1.000.000)\n3. Premium MCU (Rp 2.500.000)\n\nPaket mana yang ingin Anda ketahui lebih lanjut?',
    'basic': 'Paket Basic MCU meliputi:\n- Pemeriksaan tekanan darah\n- Tes darah dasar\n- Pemeriksaan fisik umum\nBonus wisata ke Bukit Paralayang dan Malioboro!',
    'standard': 'Paket Standard MCU meliputi:\n- Semua pemeriksaan paket Basic\n- Cek kolesterol\n- EKG\n- Tes darah lengkap\nBonus wisata ke Bukit Paralayang, Malioboro, dan Candi Prambanan!',
    'premium': 'Paket Premium MCU meliputi:\n- Semua pemeriksaan paket Standard\n- MRI\n- CT scan\n- Konsultasi spesialis\nBonus wisata ke SEMUA destinasi termasuk Borobudur dan Pantai Parangtritis!',
    'harga': 'Harga paket MCU kami:\n- Basic: Rp 500.000\n- Standard: Rp 1.000.000\n- Premium: Rp 2.500.000\n\nIngin tahu detail paket tertentu?',
    'lokasi': 'Kami memiliki jaringan rumah sakit partner di seluruh Yogyakarta. Anda dapat memilih rumah sakit saat pendaftaran.',
    'daftar': 'Untuk mendaftar MCU, Anda dapat mengisi formulir pendaftaran di website kami. Mau saya tunjukkan caranya?',
    'kontak': 'Anda dapat menghubungi kami melalui:\nEmail: info@healthnav.com\nTelepon: +62 274 123456',
    'bantuan': 'Saya dapat membantu Anda dengan:\n- Informasi paket MCU\n- Proses pendaftaran\n- Detail harga\n- Lokasi rumah sakit\n- Destinasi wisata\n\nApa yang ingin Anda ketahui?'
};

function sendMessage() {
    const input = document.getElementById('chatInput');
    const message = input.value.trim();
    
    if (message) {
        // Add user message
        const chatMessages = document.querySelector('.chat-messages');
        chatMessages.innerHTML += `
            <div class="message user-message">
                <i class="fas fa-user"></i> ${message}
            </div>
        `;

        // Show typing indicator
        const typingIndicator = document.querySelector('.typing-indicator');
        typingIndicator.style.display = 'block';

        // Clear input
        input.value = '';

        // Generate bot response
        setTimeout(() => {
            typingIndicator.style.display = 'none';
            const response = getBotResponse(message);
            chatMessages.innerHTML += `
                <div class="message bot-message">
                    <i class="fas fa-robot"></i> ${response}
                </div>
            `;

            // Scroll to bottom
            const modalBody = document.querySelector('.modal-body');
            modalBody.scrollTop = modalBody.scrollHeight;
        }, 1500);

        // Scroll to bottom
        const modalBody = document.querySelector('.modal-body');
        modalBody.scrollTop = modalBody.scrollHeight;
    }
}

function getBotResponse(message) {
    const lowerMessage = message.toLowerCase();
    
    // Check for exact matches
    for (const [key, value] of Object.entries(responses)) {
        if (lowerMessage.includes(key)) {
            return value;
        }
    }
    
    // Keyword matching
    if (lowerMessage.includes('mcu') || lowerMessage.includes('paket')) {
        return responses['paket'];
    }
    if (lowerMessage.includes('biaya') || lowerMessage.includes('harga')) {
        return responses['harga'];
    }
    if (lowerMessage.includes('daftar') || lowerMessage.includes('registrasi')) {
        return responses['daftar'];
    }
    if (lowerMessage.includes('lokasi') || lowerMessage.includes('rumah sakit')) {
        return responses['lokasi'];
    }
    
    // Default response
    return "Maaf, saya kurang memahami pertanyaan Anda. Anda dapat menanyakan tentang:\n- Paket MCU\n- Harga layanan\n- Proses pendaftaran\n- Lokasi rumah sakit\n\nAtau ketik 'bantuan' untuk informasi lebih lanjut.";
}

// Allow sending message with Enter key
document.getElementById('chatInput').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        sendMessage();
    }
});
</script>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('form-pendaftaran-mcu');
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            // Form validation and submission logic
            if (form.checkValidity() === false) {
                e.stopPropagation();
            } else {
                form.submit();
            }
            form.classList.add('was-validated');
        }, false);
    });
</script>
@endsection