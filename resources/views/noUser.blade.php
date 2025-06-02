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

<!-- MCU Packages Section -->
<section class="container mb-5">
    <h2 class="h3 mb-4">Available MCU Packages</h2>
    <div class="row">
        <!-- Basic Package -->
        <div class="col-md-4 mb-4">
            <div class="appointment-card">
                <div class="feature-icon mb-3">
                    <i class="fas fa-heartbeat" style="font-size: 48px; color: #dc3545;"></i>
                </div>
                <h4>Basic MCU</h4>
                <p class="text-muted">Essential health assessments including blood pressure and basic blood tests.</p>
                <ul class="list-unstyled text-muted">
                    <li><i class="fas fa-check text-success me-2"></i>General physical examination</li>
                    <li><i class="fas fa-check text-success me-2"></i>Basic blood tests</li>
                    <li><i class="fas fa-check text-success me-2"></i>Blood pressure check</li>
                </ul>
                <div class="mt-4">
                    <h5 class="mb-3">Rp 500.000</h5>
                    <a href="{{ route('hospitals.selection') }}" class="btn btn-danger">Book Now</a>
                </div>
            </div>
        </div>

        <!-- Standard Package -->
        <div class="col-md-4 mb-4">
            <div class="appointment-card">
                <div class="feature-icon mb-3">
                    <i class="fas fa-stethoscope" style="font-size: 48px; color: #28a745;"></i>
                </div>
                <h4>Standard MCU</h4>
                <p class="text-muted">Comprehensive tests including cholesterol levels and EKG.</p>
                <ul class="list-unstyled text-muted">
                    <li><i class="fas fa-check text-success me-2"></i>All Basic package tests</li>
                    <li><i class="fas fa-check text-success me-2"></i>EKG examination</li>
                    <li><i class="fas fa-check text-success me-2"></i>Cholesterol panel</li>
                </ul>
                <div class="mt-4">
                    <h5 class="mb-3">Rp 1.000.000</h5>
                    <a href="{{ route('hospitals.selection') }}" class="btn btn-success">Book Now</a>
                </div>
            </div>
        </div>

        <!-- Premium Package -->
        <div class="col-md-4 mb-4">
            <div class="appointment-card">
                <div class="feature-icon mb-3">
                    <i class="fas fa-user-md" style="font-size: 48px; color: #007bff;"></i>
                </div>
                <h4>Premium MCU</h4>
                <p class="text-muted">Advanced imaging tests and specialist consultations.</p>
                <ul class="list-unstyled text-muted">
                    <li><i class="fas fa-check text-success me-2"></i>All Standard package tests</li>
                    <li><i class="fas fa-check text-success me-2"></i>MRI/CT scan</li>
                    <li><i class="fas fa-check text-success me-2"></i>Specialist consultation</li>
                </ul>
                <div class="mt-4">
                    <h5 class="mb-3">Rp 2.500.000</h5>
                    <a href="{{ route('hospitals.selection') }}" class="btn btn-primary">Book Now</a>
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

<!-- Chatbot Widget -->
<style>
    /* Chatbot Styles */
    .chatbot-widget {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 1000;
    }

    .chatbot-toggle-btn {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background-color: #0d6efd;
        border: none;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        transition: all 0.3s ease;
    }

    .chatbot-toggle-btn:hover {
        transform: scale(1.1);
        background-color: #0b5ed7;
    }

    .chat-messages {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .message {
        padding: 12px 15px;
        border-radius: 15px;
        max-width: 80%;
        position: relative;
    }

    .bot-message {
        background-color: #f8f9fa;
        margin-right: auto;
        border-top-left-radius: 5px;
    }

    .user-message {
        background-color: #0d6efd;
        color: white;
        margin-left: auto;
        border-top-right-radius: 5px;
    }

    .typing-indicator {
        display: none;
        padding: 12px 15px;
        background-color: #f8f9fa;
        border-radius: 15px;
        margin-right: auto;
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

    /* Dark Mode Support */
    [data-bs-theme="dark"] .bot-message {
        background-color: #2c3034;
        color: #dee2e6;
    }

    [data-bs-theme="dark"] .typing-indicator {
        background-color: #2c3034;
    }

    [data-bs-theme="dark"] .modal-content {
        background-color: #212529;
        color: #dee2e6;
    }

    [data-bs-theme="dark"] .modal-header {
        border-bottom-color: #373b3e;
    }

    [data-bs-theme="dark"] .modal-footer {
        border-top-color: #373b3e;
    }

    [data-bs-theme="dark"] #chatInput {
        background-color: #2c3034;
        border-color: #373b3e;
        color: #dee2e6;
    }

    [data-bs-theme="dark"] .bot-message ul {
        color: #dee2e6;
    }
</style>

<div class="chatbot-widget">
    <button class="chatbot-toggle-btn d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#chatbotModal">
        <i class="fas fa-comments fs-4 text-white"></i>
    </button>
</div>

<!-- Chatbot Modal -->
<div class="modal fade" id="chatbotModal" tabindex="-1" aria-labelledby="chatbotModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <div class="d-flex align-items-center">
                    <img src="/images/jih-logo.png" alt="Bot Avatar" class="rounded-circle me-2" width="40" height="40" style="object-fit: cover;">
                    <div>
                        <h5 class="modal-title mb-0" id="chatbotModalLabel">
                            <i class="fas fa-robot me-2"></i>Asisten RS JIH
                        </h5>
                        <small><i class="fas fa-circle text-success me-1"></i>Online</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="height: 400px; overflow-y: auto; padding: 20px;">
                <div class="chat-messages">
                    <div class="message bot-message">
                        <i class="fas fa-robot me-2"></i>Halo! Saya asisten virtual RS JIH. Ada yang bisa saya bantu?
                    </div>
                    <div class="message bot-message">
                        <i class="fas fa-info-circle me-2"></i>Saya dapat membantu Anda dengan:
                        <ul class="mt-2 mb-0 ps-4">
                            <li><i class="fas fa-hospital me-2"></i>Informasi layanan rumah sakit</li>
                            <li><i class="fas fa-calendar-check me-2"></i>Jadwal dokter</li>
                            <li><i class="fas fa-user-plus me-2"></i>Pendaftaran online</li>
                            <li><i class="fas fa-bed me-2"></i>Informasi kamar rawat inap</li>
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
                    <input type="text" id="chatInput" class="form-control" placeholder="Ketik pesan Anda..." aria-label="Chat message">
                    <button class="btn btn-primary" onclick="sendMessage()">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function sendMessage() {
        const input = document.getElementById('chatInput');
        const message = input.value.trim();
        
        if (message) {
            const chatMessages = document.querySelector('.chat-messages');
            const modalBody = document.querySelector('.modal-body');
            
            // Add user message
            chatMessages.innerHTML += `
                <div class="message user-message">
                    ${message}
                    <i class="fas fa-user ms-2"></i>
                </div>
            `;

            // Clear input
            input.value = '';

            // Show typing indicator
            const typingIndicator = document.querySelector('.typing-indicator');
            typingIndicator.style.display = 'block';
            modalBody.scrollTop = modalBody.scrollHeight;

            // Simulate bot response
            setTimeout(() => {
                typingIndicator.style.display = 'none';
                
                // Predefined responses based on keywords
                let botResponse = '';
                const lowerMessage = message.toLowerCase();
                
                if (lowerMessage.includes('jadwal') || lowerMessage.includes('dokter')) {
                    botResponse = `
                        <div class="message bot-message">
                            <i class="fas fa-calendar-check me-2"></i>
                            Untuk informasi jadwal dokter, silakan:
                            <ul class="mt-2 mb-0 ps-4">
                                <li>Kunjungi website RS JIH</li>
                                <li>Hubungi call center: (0274) 4463535</li>
                                <li>Atau login untuk melihat jadwal lengkap</li>
                            </ul>
                        </div>
                    `;
                } else if (lowerMessage.includes('daftar') || lowerMessage.includes('registrasi')) {
                    botResponse = `
                        <div class="message bot-message">
                            <i class="fas fa-user-plus me-2"></i>
                            Untuk pendaftaran online, silakan:
                            <ul class="mt-2 mb-0 ps-4">
                                <li>Login/Register di website kami</li>
                                <li>Pilih layanan yang diinginkan</li>
                                <li>Ikuti panduan pendaftaran</li>
                            </ul>
                        </div>
                    `;
                } else if (lowerMessage.includes('kamar') || lowerMessage.includes('rawat inap')) {
                    botResponse = `
                        <div class="message bot-message">
                            <i class="fas fa-bed me-2"></i>
                            Informasi kamar rawat inap:
                            <ul class="mt-2 mb-0 ps-4">
                                <li>VIP, VVIP, Kelas 1, 2, dan 3</li>
                                <li>Fasilitas lengkap sesuai kelas</li>
                                <li>Login untuk melihat ketersediaan</li>
                            </ul>
                        </div>
                    `;
                } else {
                    botResponse = `
                        <div class="message bot-message">
                            <i class="fas fa-robot me-2"></i>
                            Terima kasih atas pertanyaan Anda. Untuk informasi lebih lanjut, silakan:
                            <ul class="mt-2 mb-0 ps-4">
                                <li>Login untuk akses lengkap</li>
                                <li>Hubungi call center: (0274) 4463535</li>
                                <li>Kunjungi RS JIH secara langsung</li>
                            </ul>
                        </div>
                    `;
                }

                chatMessages.innerHTML += botResponse;
                modalBody.scrollTop = modalBody.scrollHeight;
            }, 1500);
        }
    }

    // Send message with Enter key
    document.getElementById('chatInput').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            sendMessage();
        }
    });

    // Reset chat when modal is closed
    document.getElementById('chatbotModal').addEventListener('hidden.bs.modal', function () {
        const chatMessages = document.querySelector('.chat-messages');
        chatMessages.innerHTML = `
            <div class="message bot-message">
                <i class="fas fa-robot me-2"></i>Halo! Saya asisten virtual RS JIH. Ada yang bisa saya bantu?
            </div>
            <div class="message bot-message">
                <i class="fas fa-info-circle me-2"></i>Saya dapat membantu Anda dengan:
                <ul class="mt-2 mb-0 ps-4">
                    <li><i class="fas fa-hospital me-2"></i>Informasi layanan rumah sakit</li>
                    <li><i class="fas fa-calendar-check me-2"></i>Jadwal dokter</li>
                    <li><i class="fas fa-user-plus me-2"></i>Pendaftaran online</li>
                    <li><i class="fas fa-bed me-2"></i>Informasi kamar rawat inap</li>
                </ul>
            </div>
        `;
        document.getElementById('chatInput').value = '';
    });
</script>

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