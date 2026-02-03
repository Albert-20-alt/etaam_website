<?php
$pageTitle = "Contact | ETAAM | Solutions IT & Technologie au Sénégal";
$currentPage = "contact";

// Load Settings
// Load Settings
require_once __DIR__ . '/includes/db_connect.php';
$settingsData = [];
try {
    $stmt = $pdo->query("SELECT setting_key, setting_value FROM settings");
    $settingsData = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
} catch (PDOException $e) {}

// Defaults
$email = $settingsData['email'] ?? 'contact@etaam.sn';
$phone = $settingsData['phone'] ?? '+221 33 888 88 88';
$address = $settingsData['address'] ?? "Ziguinchor, Sénégal\nKénia - Université Assane Seck";
$fb = $settingsData['facebook'] ?? '#';
$tw = $settingsData['twitter'] ?? '#';
$li = $settingsData['linkedin'] ?? '#';

include 'includes/header.php';
?>

<!--Page Header Start-->
        <section class="page-header"
            style="position: relative; overflow: hidden; padding: 120px 0 100px; background: linear-gradient(135deg, #0f0f23 0%, #1a1a2e 30%, #2d1f4e 60%, #6A4C93 100%);">
            <!-- Animated Background Elements -->
            <div class="header-bg-elements" style="position: absolute; inset: 0; overflow: hidden;">
                <!-- Floating Circles -->
                <div
                    style="position: absolute; top: 10%; left: 5%; width: 120px; height: 120px; background: radial-gradient(circle, rgba(0, 210, 211, 0.15), transparent 70%); border-radius: 50%; animation: float 8s ease-in-out infinite;">
                </div>
                <div
                    style="position: absolute; top: 60%; right: 10%; width: 180px; height: 180px; background: radial-gradient(circle, rgba(106, 76, 147, 0.2), transparent 70%); border-radius: 50%; animation: float 10s ease-in-out infinite reverse;">
                </div>
                <div
                    style="position: absolute; bottom: 20%; left: 20%; width: 80px; height: 80px; background: radial-gradient(circle, rgba(255, 107, 107, 0.1), transparent 70%); border-radius: 50%; animation: float 6s ease-in-out infinite;">
                </div>

                <!-- Geometric Lines -->
                <div
                    style="position: absolute; top: 30%; left: -5%; width: 400px; height: 1px; background: linear-gradient(90deg, transparent, rgba(0, 210, 211, 0.3), transparent); transform: rotate(-15deg);">
                </div>
                <div
                    style="position: absolute; bottom: 40%; right: -5%; width: 300px; height: 1px; background: linear-gradient(90deg, transparent, rgba(106, 76, 147, 0.4), transparent); transform: rotate(20deg);">
                </div>

                <!-- Grid Pattern -->
                <div
                    style="position: absolute; inset: 0; background-image: linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px); background-size: 50px 50px; opacity: 0.5;">
                </div>

                <!-- Floating Tech Icons -->
                <div
                    style="position: absolute; top: 25%; right: 15%; color: rgba(0, 210, 211, 0.2); font-size: 40px; animation: floatIcon 7s ease-in-out infinite;">
                    <i class="fas fa-comments"></i>
                </div>
                <div
                    style="position: absolute; bottom: 30%; left: 10%; color: rgba(106, 76, 147, 0.25); font-size: 35px; animation: floatIcon 9s ease-in-out infinite reverse;">
                    <i class="fas fa-envelope-open-text"></i>
                </div>
                <div
                    style="position: absolute; top: 50%; right: 25%; color: rgba(255, 107, 107, 0.15); font-size: 28px; animation: floatIcon 6s ease-in-out infinite;">
                    <i class="fas fa-headset"></i>
                </div>
            </div>

            <!-- Content -->
            <div class="container" style="position: relative; z-index: 2;">
                <div class="page-header__inner text-center">
                    <!-- Breadcrumb -->
                    <nav style="margin-bottom: 25px;">
                        <ul class="thm-breadcrumb list-unstyled"
                            style="display: flex; justify-content: center; align-items: center; gap: 10px; margin: 0;">
                            <li><a href="index.php"
                                    style="color: rgba(255,255,255,0.7); text-decoration: none; transition: all 0.3s ease;">Accueil</a>
                            </li>
                            <li><span style="color: rgba(255,255,255,0.4);">•</span></li>
                            <li class="active" style="color: #00d2d3;">Contact</li>
                        </ul>
                    </nav>

                    <!-- Main Title -->
                    <h1
                        style="font-size: 52px; font-weight: 700; margin-bottom: 20px; background: linear-gradient(135deg, #ffffff 0%, #00d2d3 50%, #6A4C93 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                        Contactez-nous
                    </h1>

                    <!-- Subtitle -->
                    <p
                        style="color: rgba(255,255,255,0.7); font-size: 18px; max-width: 600px; margin: 0 auto 30px; line-height: 1.7;">
                        Notre équipe est à votre écoute pour transformer vos idées en solutions digitales innovantes
                    </p>

                    <!-- CTA Buttons -->
                    <div style="display: flex; justify-content: center; gap: 15px; flex-wrap: wrap;">
                        <a href="tel:+221338888888"
                            style="display: inline-flex; align-items: center; gap: 10px; background: linear-gradient(135deg, #6A4C93 0%, #8B5CF6 100%); color: white; padding: 14px 28px; border-radius: 50px; text-decoration: none; font-weight: 500; transition: all 0.3s ease; box-shadow: 0 10px 30px rgba(106, 76, 147, 0.4);">
                            <i class="fas fa-phone-alt"></i>
                            <span>Appelez-nous</span>
                        </a>
                        <a href="https://wa.me/221778888888" target="_blank"
                            style="display: inline-flex; align-items: center; gap: 10px; background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2); color: white; padding: 14px 28px; border-radius: 50px; text-decoration: none; font-weight: 500; transition: all 0.3s ease;">
                            <i class="fab fa-whatsapp"></i>
                            <span>WhatsApp</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Bottom Wave -->
            <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 80px; overflow: hidden;">
                <svg viewBox="0 0 1200 120" preserveAspectRatio="none" style="width: 100%; height: 100%;">
                    <path d="M0,60 C150,120 350,0 600,60 C850,120 1050,0 1200,60 L1200,120 L0,120 Z" fill="#0f0f23">
                    </path>
                </svg>
            </div>

            <!-- Animations -->
            <style>
                @keyframes float {

                    0%,
                    100% {
                        transform: translateY(0) rotate(0deg);
                    }

                    50% {
                        transform: translateY(-20px) rotate(5deg);
                    }
                }

                @keyframes floatIcon {

                    0%,
                    100% {
                        transform: translateY(0) scale(1);
                        opacity: 0.2;
                    }

                    50% {
                        transform: translateY(-15px) scale(1.1);
                        opacity: 0.35;
                    }
                }

                .page-header a:hover {
                    transform: translateY(-3px);
                    box-shadow: 0 15px 40px rgba(106, 76, 147, 0.5) !important;
                }

                .page-header .thm-breadcrumb a:hover {
                    color: #00d2d3 !important;
                }
            </style>
        </section>
        <!--Page Header End-->

        <!--Contact Details End-->

        <!--Interactive Contact Flow Start-->
        <section class="contact-flow"
            style="padding: 80px 0; background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f0f23 100%); min-height: 80vh;">
            <div class="container">
                <!-- Progress Bar -->
                <div class="progress-container" style="max-width: 600px; margin: 0 auto 50px;">
                    <div class="progress-bar-wrapper"
                        style="display: flex; justify-content: space-between; position: relative;">
                        <div class="progress-line"
                            style="position: absolute; top: 20px; left: 0; right: 0; height: 4px; background: rgba(255,255,255,0.2); border-radius: 2px; z-index: 1;">
                        </div>
                        <div class="progress-line-active" id="progressLine"
                            style="position: absolute; top: 20px; left: 0; width: 0%; height: 4px; background: linear-gradient(90deg, #6A4C93, #00d2d3); border-radius: 2px; z-index: 2; transition: width 0.5s ease;">
                        </div>
                        <div class="progress-step active" data-step="1"
                            style="width: 40px; height: 40px; border-radius: 50%; background: #6A4C93; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; z-index: 3; transition: all 0.3s ease;">
                            1</div>
                        <div class="progress-step" data-step="2"
                            style="width: 40px; height: 40px; border-radius: 50%; background: rgba(255,255,255,0.2); display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; z-index: 3; transition: all 0.3s ease;">
                            2</div>
                        <div class="progress-step" data-step="3"
                            style="width: 40px; height: 40px; border-radius: 50%; background: rgba(255,255,255,0.2); display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; z-index: 3; transition: all 0.3s ease;">
                            3</div>
                        <div class="progress-step" data-step="4"
                            style="width: 40px; height: 40px; border-radius: 50%; background: rgba(255,255,255,0.2); display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; z-index: 3; transition: all 0.3s ease;">
                            4</div>
                    </div>
                </div>

                <!-- Questions Container -->
                <div class="questions-container" style="max-width: 800px; margin: 0 auto;">

                    <?php include 'includes/contact_data.php'; ?>

                    <?php foreach ($contactSteps as $stepNumber => $step): ?>
                        <div class="question-step <?php echo ($stepNumber === 1) ? 'active' : ''; ?>" id="<?php echo $step['id']; ?>" style="display: <?php echo ($stepNumber === 1) ? 'block' : 'none'; ?>;">
                            <div class="text-center mb-5">
                                <span style="color: #00d2d3; font-size: 14px; text-transform: uppercase; letter-spacing: 2px;">
                                    Étape <?php echo $step['step_number']; ?>/4
                                </span>
                                <h2 style="color: white; font-size: 32px; margin-top: 15px;"><?php echo $step['title']; ?></h2>
                                <p style="color: rgba(255,255,255,0.7);"><?php echo $step['subtitle']; ?></p>
                            </div>
                            <div class="options-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
                                <?php foreach ($step['options'] as $option): ?>
                                    <div class="option-card" data-value="<?php echo $option['value']; ?>" onclick="selectOption(this, <?php echo $stepNumber; ?>)"
                                        style="background: rgba(255,255,255,0.05); border: 2px solid rgba(255,255,255,0.1); border-radius: 16px; padding: <?php echo (isset($option['icon']) && $option['icon'] !== '') ? '30px' : '25px'; ?> 20px; text-align: center; cursor: pointer; transition: all 0.3s ease;">
                                        
                                        <?php if (isset($option['icon']) && $option['icon'] !== ''): ?>
                                            <i class="<?php echo $option['icon']; ?>" style="font-size: 40px; color: <?php echo $option['icon_color']; ?>; margin-bottom: 15px;"></i>
                                        <?php endif; ?>

                                        <h4 style="color: white; margin-bottom: <?php echo (isset($option['icon']) && $option['icon'] !== '') ? '10px' : '5px'; ?>;">
                                            <?php echo $option['title']; ?>
                                        </h4>
                                        <p style="color: rgba(255,255,255,0.6); font-size: 13px;"><?php echo $option['description']; ?></p>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <?php if ($stepNumber > 1): ?>
                                <div class="text-center mt-4">
                                    <button onclick="prevStep()" class="btn-nav"
                                        style="background: transparent; border: 2px solid rgba(255,255,255,0.3); color: white; padding: 12px 30px; border-radius: 30px; cursor: pointer; transition: all 0.3s ease;">
                                        <i class="fas fa-arrow-left me-2"></i> Précédent
                                    </button>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </section>
        <!--Interactive Contact Flow End-->

        <!-- Contact Modal -->
        <div class="modal fade" id="contactModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content"
                    style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%); border: 1px solid rgba(255,255,255,0.1); border-radius: 20px;">
                    <div class="modal-header"
                        style="border-bottom: 1px solid rgba(255,255,255,0.1); padding: 25px 30px;">
                        <h5 class="modal-title" style="color: white; font-size: 24px;"><i
                                class="fas fa-check-circle me-2" style="color: #00d2d3;"></i>Finalisez votre demande
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="padding: 30px;">
                        <!-- Summary -->
                        <div class="summary-box"
                            style="background: rgba(106, 76, 147, 0.2); border-radius: 12px; padding: 20px; margin-bottom: 25px;">
                            <h6
                                style="color: #00d2d3; font-size: 14px; text-transform: uppercase; margin-bottom: 15px;">
                                Résumé de votre demande</h6>
                            <div id="summaryContent" style="color: rgba(255,255,255,0.8); font-size: 14px;"></div>
                        </div>

                        <!-- Contact Form -->
                        <form id="finalContactForm">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label
                                        style="color: rgba(255,255,255,0.7); font-size: 14px; margin-bottom: 8px;">Nom
                                        complet *</label>
                                    <input type="text" id="contactName" required
                                        style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.2); border-radius: 10px; padding: 12px 15px; color: white; outline: none;">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label
                                        style="color: rgba(255,255,255,0.7); font-size: 14px; margin-bottom: 8px;">Email
                                        *</label>
                                    <input type="email" id="contactEmail" required
                                        style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.2); border-radius: 10px; padding: 12px 15px; color: white; outline: none;">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label
                                        style="color: rgba(255,255,255,0.7); font-size: 14px; margin-bottom: 8px;">Téléphone
                                        *</label>
                                    <input type="tel" id="contactPhone" required placeholder="+221 XX XXX XX XX"
                                        style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.2); border-radius: 10px; padding: 12px 15px; color: white; outline: none;">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label
                                        style="color: rgba(255,255,255,0.7); font-size: 14px; margin-bottom: 8px;">Entreprise
                                        / Organisation</label>
                                    <input type="text" id="contactCompany"
                                        style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.2); border-radius: 10px; padding: 12px 15px; color: white; outline: none;">
                                </div>
                            </div>

                            <!-- Appointment Section -->
                            <div class="appointment-section"
                                style="margin-top: 20px; padding-top: 20px; border-top: 1px solid rgba(255,255,255,0.1);">
                                <div class="form-check mb-3">
                                    <input type="checkbox" class="form-check-input" id="wantAppointment"
                                        onchange="toggleAppointment()"
                                        style="background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.3);">
                                    <label class="form-check-label" for="wantAppointment"
                                        style="color: white; cursor: pointer;">
                                        <i class="fas fa-calendar-check me-2" style="color: #00d2d3;"></i>Je souhaite
                                        planifier un rendez-vous
                                    </label>
                                </div>
                                <div id="appointmentFields" style="display: none;">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label
                                                style="color: rgba(255,255,255,0.7); font-size: 14px; margin-bottom: 8px;">Date
                                                souhaitée</label>
                                            <input type="date" id="appointmentDate"
                                                style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.2); border-radius: 10px; padding: 12px 15px; color: white; outline: none;">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label
                                                style="color: rgba(255,255,255,0.7); font-size: 14px; margin-bottom: 8px;">Heure
                                                préférée</label>
                                            <select id="appointmentTime"
                                                style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.2); border-radius: 10px; padding: 12px 15px; color: white; outline: none;">
                                                <option value="">Choisir une heure</option>
                                                <option value="09:00">09:00</option>
                                                <option value="10:00">10:00</option>
                                                <option value="11:00">11:00</option>
                                                <option value="14:00">14:00</option>
                                                <option value="15:00">15:00</option>
                                                <option value="16:00">16:00</option>
                                                <option value="17:00">17:00</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 mt-3">
                                <label
                                    style="color: rgba(255,255,255,0.7); font-size: 14px; margin-bottom: 8px;">Message
                                    additionnel (optionnel)</label>
                                <textarea id="contactMessage" rows="3"
                                    style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.2); border-radius: 10px; padding: 12px 15px; color: white; outline: none; resize: none;"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer" style="border-top: 1px solid rgba(255,255,255,0.1); padding: 20px 30px;">
                        <button type="button" class="btn" data-bs-dismiss="modal"
                            style="background: transparent; border: 1px solid rgba(255,255,255,0.3); color: white; padding: 12px 25px; border-radius: 30px;">Annuler</button>
                        <button type="button" onclick="submitForm()" class="btn"
                            style="background: linear-gradient(135deg, #6A4C93 0%, #00d2d3 100%); color: white; padding: 12px 30px; border-radius: 30px; border: none;">
                            <i class="fas fa-paper-plane me-2"></i>Envoyer ma demande
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success Modal -->
        <div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content"
                    style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%); border: 1px solid rgba(255,255,255,0.1); border-radius: 20px; text-align: center; padding: 50px 30px;">
                    <div
                        style="width: 80px; height: 80px; background: linear-gradient(135deg, #6A4C93 0%, #00d2d3 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
                        <i class="fas fa-check" style="font-size: 40px; color: white;"></i>
                    </div>
                    <h3 style="color: white; margin-bottom: 15px;">Demande envoyée !</h3>
                    <p style="color: rgba(255,255,255,0.7); margin-bottom: 25px;">Merci pour votre confiance. Notre
                        équipe vous contactera dans les plus brefs délais.</p>
                    <button type="button" class="btn" data-bs-dismiss="modal" onclick="resetForm()"
                        style="background: linear-gradient(135deg, #6A4C93 0%, #00d2d3 100%); color: white; padding: 12px 40px; border-radius: 30px; border: none;">
                        Fermer
                    </button>
                </div>
            </div>
        </div>

        <!-- Error Modal -->
        <div class="modal fade" id="errorModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content"
                    style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%); border: 1px solid rgba(255,107,107,0.3); border-radius: 20px; text-align: center; padding: 50px 30px;">
                    <div
                        style="width: 80px; height: 80px; background: linear-gradient(135deg, #FF6B6B 0%, #ee5a5a 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
                        <i class="fas fa-exclamation-triangle" style="font-size: 35px; color: white;"></i>
                    </div>
                    <h3 style="color: white; margin-bottom: 15px;">Une erreur est survenue</h3>
                    <p id="errorMessage" style="color: rgba(255,255,255,0.7); margin-bottom: 25px;">Nous n'avons pas pu
                        envoyer votre demande. Veuillez réessayer.</p>
                    <button type="button" class="btn" data-bs-dismiss="modal"
                        style="background: rgba(255,255,255,0.1); color: white; padding: 12px 40px; border-radius: 30px; border: 1px solid rgba(255,255,255,0.2);">
                        Fermer
                    </button>
                    <a href="mailto:contact@etaam.sn?subject=Contact%20Urgent" class="btn ms-2"
                        style="background: linear-gradient(135deg, #FF6B6B 0%, #ee5a5a 100%); color: white; padding: 12px 40px; border-radius: 30px; border: none; margin-top: 10px; display: inline-block;">
                        Envoyer par email
                    </a>
                </div>
            </div>
        </div>

        <!-- Custom Styles -->
        <style>
            .option-card:hover {
                border-color: #6A4C93 !important;
                transform: translateY(-5px);
                box-shadow: 0 10px 30px rgba(106, 76, 147, 0.3);
            }

            .option-card.selected {
                border-color: #00d2d3 !important;
                background: rgba(0, 210, 211, 0.1) !important;
            }

            .option-card.selected h4 {
                color: #00d2d3 !important;
            }

            .progress-step.active {
                background: linear-gradient(135deg, #6A4C93 0%, #00d2d3 100%) !important;
                transform: scale(1.1);
            }

            .progress-step.completed {
                background: #00d2d3 !important;
            }

            .btn-nav:hover {
                background: rgba(255, 255, 255, 0.1) !important;
                border-color: white !important;
            }

            .question-step {
                animation: fadeIn 0.5s ease;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            #appointmentFields input,
            #appointmentFields select {
                color-scheme: dark;
            }

            .modal-content input:focus,
            .modal-content select:focus,
            .modal-content textarea:focus {
                border-color: #6A4C93 !important;
                box-shadow: 0 0 0 3px rgba(106, 76, 147, 0.2);
            }
        </style>

        <!-- JavaScript for Flow Logic -->
        <script>
            let currentStep = 1;
            const totalSteps = 4;
            const userChoices = {};

            const choiceLabels = <?php 
                $jsLabels = [];
                foreach ($contactSteps as $step) {
                    foreach ($step['options'] as $opt) {
                        // Create a detailed label including description if possible, or just title
                        $label = $opt['title'];
                        if (isset($opt['description']) && !empty($opt['description'])) {
                             // For specific fields like urgency, the original code had custom formatting
                             // We can keep it simple or enhance: "$title ($description)"
                             if ($step['id'] === 'step4') { // urgency
                                 $label .= ' (' . $opt['description'] . ')';
                             }
                        }
                        $jsLabels[$opt['value']] = $label;
                    }
                }
                echo json_encode($jsLabels);
            ?>;

            function selectOption(element, step) {
                // Remove selection from siblings
                const parent = element.parentElement;
                parent.querySelectorAll('.option-card').forEach(card => {
                    card.classList.remove('selected');
                });

                // Add selection to clicked element
                element.classList.add('selected');

                // Store choice
                const stepNames = ['', 'besoin', 'domaine', 'budget', 'delai'];
                userChoices[stepNames[step]] = element.dataset.value;

                // Auto-advance after short delay
                setTimeout(() => {
                    if (step < totalSteps) {
                        nextStep();
                    } else {
                        showModal();
                    }
                }, 400);
            }

            function nextStep() {
                if (currentStep < totalSteps) {
                    document.getElementById('step' + currentStep).style.display = 'none';
                    currentStep++;
                    document.getElementById('step' + currentStep).style.display = 'block';
                    updateProgress();
                }
            }

            function prevStep() {
                if (currentStep > 1) {
                    document.getElementById('step' + currentStep).style.display = 'none';
                    currentStep--;
                    document.getElementById('step' + currentStep).style.display = 'block';
                    updateProgress();
                }
            }

            function updateProgress() {
                const progressLine = document.getElementById('progressLine');
                const percentage = ((currentStep - 1) / (totalSteps - 1)) * 100;
                progressLine.style.width = percentage + '%';

                document.querySelectorAll('.progress-step').forEach((step, index) => {
                    if (index + 1 < currentStep) {
                        step.classList.add('completed');
                        step.classList.remove('active');
                    } else if (index + 1 === currentStep) {
                        step.classList.add('active');
                        step.classList.remove('completed');
                    } else {
                        step.classList.remove('active', 'completed');
                    }
                });
            }

            function showModal() {
                // Build summary
                let summaryHTML = '<ul style="list-style: none; padding: 0; margin: 0;">';
                summaryHTML += '<li style="margin-bottom: 8px;"><strong style="color: #6A4C93;">Besoin:</strong> ' + (choiceLabels[userChoices.besoin] || userChoices.besoin) + '</li>';
                summaryHTML += '<li style="margin-bottom: 8px;"><strong style="color: #6A4C93;">Domaine:</strong> ' + (choiceLabels[userChoices.domaine] || userChoices.domaine) + '</li>';
                summaryHTML += '<li style="margin-bottom: 8px;"><strong style="color: #6A4C93;">Budget:</strong> ' + (choiceLabels[userChoices.budget] || userChoices.budget) + '</li>';
                summaryHTML += '<li><strong style="color: #6A4C93;">Délai:</strong> ' + (choiceLabels[userChoices.delai] || userChoices.delai) + '</li>';
                summaryHTML += '</ul>';

                document.getElementById('summaryContent').innerHTML = summaryHTML;

                // Show modal
                const modal = new bootstrap.Modal(document.getElementById('contactModal'));
                modal.show();
            }

            function toggleAppointment() {
                const appointmentFields = document.getElementById('appointmentFields');
                const checkbox = document.getElementById('wantAppointment');
                appointmentFields.style.display = checkbox.checked ? 'block' : 'none';
            }

            async function submitForm() {
                const name = document.getElementById('contactName').value;
                const email = document.getElementById('contactEmail').value;
                const phone = document.getElementById('contactPhone').value;
                const company = document.getElementById('contactCompany').value;
                const message = document.getElementById('contactMessage').value;

                // Appointment details
                const wantAppointment = document.getElementById('wantAppointment').checked;
                const appointmentDate = wantAppointment ? document.getElementById('appointmentDate').value : null;
                const appointmentTime = wantAppointment ? document.getElementById('appointmentTime').value : null;


                if (!name || !email || !phone) {
                    alert('Veuillez remplir tous les champs obligatoires.');
                    return;
                }

                const submitBtn = document.querySelector('button[onclick="submitForm()"]');
                const originalBtnText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Envoi...';
                submitBtn.disabled = true;

                const formData = {
                    name,
                    email,
                    phone,
                    company,
                    message,
                    type: userChoices.besoin,
                    domain: userChoices.domaine,
                    budget: userChoices.budget,
                    urgency: userChoices.delai,
                    appointment_date: appointmentDate,
                    appointment_time: appointmentTime
                };

                try {
                    // Send data to backend
                    const response = await fetch('send_email.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(formData)
                    });

                    // Check if response is JSON
                    const contentType = response.headers.get("content-type");
                    let result = null;
                    if (contentType && contentType.indexOf("application/json") !== -1) {
                        result = await response.json();
                    } else {
                        // Not JSON (likely a 500 error page or 404)
                        throw new Error("Réponse serveur inattendue. Veuillez réessayer plus tard.");
                    }

                    if (response.ok && result.success) {
                        // Close contact modal
                        bootstrap.Modal.getInstance(document.getElementById('contactModal')).hide();

                        // Show success modal
                        setTimeout(() => {
                            const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                            successModal.show();
                        }, 300);
                    } else {
                        throw new Error(result.message || 'Une erreur est survenue lors de l\'envoi.');
                    }

                } catch (error) {
                    console.error('Error:', error);
                    // Close contact modal
                    bootstrap.Modal.getInstance(document.getElementById('contactModal')).hide();

                    // Show error modal
                    document.getElementById('errorMessage').innerText = error.message || "Erreur de connexion au serveur.";
                    setTimeout(() => {
                        const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                        errorModal.show();
                    }, 300);
                } finally {
                    submitBtn.innerHTML = originalBtnText;
                    submitBtn.disabled = false;
                }
            }

            function resetForm() {
                currentStep = 1;
                userChoices.besoin = null;
                userChoices.domaine = null;
                userChoices.budget = null;
                userChoices.delai = null;

                document.querySelectorAll('.question-step').forEach((step, index) => {
                    step.style.display = index === 0 ? 'block' : 'none';
                });

                document.querySelectorAll('.option-card').forEach(card => {
                    card.classList.remove('selected');
                });

                document.getElementById('finalContactForm').reset();
                document.getElementById('appointmentFields').style.display = 'none';
                updateProgress();
            }

            // Set min date to today
            document.addEventListener('DOMContentLoaded', function () {
                const today = new Date().toISOString().split('T')[0];
                const dateInput = document.getElementById('appointmentDate');
                if (dateInput) {
                    dateInput.setAttribute('min', today);
                }
            });
        </script>

        <!--Contact Page End-->

        <!--Contact Info Section Start-->
        <section class="contact-info-section"
            style="padding: 80px 0; background: linear-gradient(180deg, #0f0f23 0%, #1a1a2e 100%); position: relative; overflow: hidden;">
            <!-- Decorative Elements -->
            <div
                style="position: absolute; top: -100px; right: -100px; width: 300px; height: 300px; background: radial-gradient(circle, rgba(106, 76, 147, 0.3), transparent); border-radius: 50%; filter: blur(60px);">
            </div>
            <div
                style="position: absolute; bottom: -100px; left: -100px; width: 250px; height: 250px; background: radial-gradient(circle, rgba(0, 210, 211, 0.2), transparent); border-radius: 50%; filter: blur(60px);">
            </div>

            <div class="container" style="position: relative; z-index: 2;">
                <div class="text-center mb-5">
                    <span
                        style="color: #00d2d3; font-size: 14px; text-transform: uppercase; letter-spacing: 3px;">RETROUVEZ-NOUS</span>
                    <h2 style="color: white; font-size: 36px; margin-top: 15px;">Nos Coordonnées</h2>
                </div>

                <div class="row g-4">
                    <!-- Location Card -->
                    <div class="col-lg-4 col-md-6">
                        <div class="contact-card"
                            style="background: rgba(255,255,255,0.03); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.08); border-radius: 24px; padding: 40px 30px; text-align: center; height: 100%; transition: all 0.4s ease;">
                            <div
                                style="width: 80px; height: 80px; background: linear-gradient(135deg, #6A4C93 0%, #8B5CF6 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px; box-shadow: 0 10px 40px rgba(106, 76, 147, 0.4);">
                                <i class="fas fa-map-marker-alt" style="font-size: 32px; color: white;"></i>
                            </div>
                            <h4 style="color: white; font-size: 22px; margin-bottom: 15px;">Notre Adresse</h4>
                            <p style="color: rgba(255,255,255,0.7); line-height: 1.8; margin-bottom: 20px;">
                            <p style="color: rgba(255,255,255,0.7); line-height: 1.8; margin-bottom: 20px;">
                                <?php echo nl2br($address); ?>
                            </p>
                            <a href="https://maps.google.com/?q=Universite+Assane+Seck+Ziguinchor" target="_blank"
                                style="display: inline-flex; align-items: center; color: #00d2d3; text-decoration: none; font-weight: 500; transition: all 0.3s ease;">
                                <span>Voir sur la carte</span>
                                <i class="fas fa-external-link-alt" style="margin-left: 8px; font-size: 12px;"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Contact Card -->
                    <div class="col-lg-4 col-md-6">
                        <div class="contact-card"
                            style="background: rgba(255,255,255,0.03); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.08); border-radius: 24px; padding: 40px 30px; text-align: center; height: 100%; transition: all 0.4s ease;">
                            <div
                                style="width: 80px; height: 80px; background: linear-gradient(135deg, #00d2d3 0%, #00a8a8 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px; box-shadow: 0 10px 40px rgba(0, 210, 211, 0.4);">
                                <i class="fas fa-phone-alt" style="font-size: 32px; color: white;"></i>
                            </div>
                            <h4 style="color: white; font-size: 22px; margin-bottom: 15px;">Appelez-nous</h4>
                            <p style="color: rgba(255,255,255,0.7); line-height: 1.8; margin-bottom: 10px;">
                                Du lundi au vendredi<br>
                                <span style="color: rgba(255,255,255,0.5);">08h00 - 18h00</span>
                            </p>
                            <a href="tel:<?php echo preg_replace('/[^0-9+]/', '', $phone); ?>"
                                style="display: block; color: white; font-size: 24px; font-weight: 600; text-decoration: none; margin-top: 15px; transition: all 0.3s ease;">
                                <?php echo $phone; ?>
                            </a>
                            <a href="https://wa.me/221778888888" target="_blank"
                                style="display: inline-flex; align-items: center; color: #25D366; text-decoration: none; font-weight: 500; margin-top: 15px; transition: all 0.3s ease;">
                                <i class="fab fa-whatsapp" style="margin-right: 8px; font-size: 18px;"></i>
                                WhatsApp
                            </a>
                        </div>
                    </div>

                    <!-- Email Card -->
                    <div class="col-lg-4 col-md-6">
                        <div class="contact-card"
                            style="background: rgba(255,255,255,0.03); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.08); border-radius: 24px; padding: 40px 30px; text-align: center; height: 100%; transition: all 0.4s ease;">
                            <div
                                style="width: 80px; height: 80px; background: linear-gradient(135deg, #FF6B6B 0%, #ee5a5a 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px; box-shadow: 0 10px 40px rgba(255, 107, 107, 0.4);">
                                <i class="fas fa-envelope" style="font-size: 32px; color: white;"></i>
                            </div>
                            <h4 style="color: white; font-size: 22px; margin-bottom: 15px;">Écrivez-nous</h4>
                            <p style="color: rgba(255,255,255,0.7); line-height: 1.8; margin-bottom: 10px;">
                                Réponse garantie sous 24h<br>
                                <span style="color: rgba(255,255,255,0.5);">Du lundi au samedi</span>
                            </p>
                            <a href="mailto:<?php echo $email; ?>"
                                style="display: block; color: white; font-size: 18px; font-weight: 600; text-decoration: none; margin-top: 15px; transition: all 0.3s ease;">
                                <?php echo $email; ?>
                            </a>
                            <a href="mailto:info@etaam.sn"
                                style="display: block; color: rgba(255,255,255,0.6); font-size: 14px; text-decoration: none; margin-top: 8px;">
                                info@etaam.sn
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Social Links -->
                <div class="text-center mt-5 pt-4">
                    <p style="color: rgba(255,255,255,0.6); margin-bottom: 20px;">Suivez-nous sur les réseaux sociaux
                    </p>
                    <div class="social-links" style="display: flex; justify-content: center; gap: 15px;">
                        <a href="<?php echo $tw; ?>"
                            style="width: 50px; height: 50px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; text-decoration: none; transition: all 0.3s ease;"
                            onmouseover="this.style.background='#1DA1F2'; this.style.borderColor='#1DA1F2';"
                            onmouseout="this.style.background='rgba(255,255,255,0.05)'; this.style.borderColor='rgba(255,255,255,0.1)';">
                            <i class="fab fa-twitter" style="font-size: 20px;"></i>
                        </a>
                        <a href="<?php echo $fb; ?>"
                            style="width: 50px; height: 50px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; text-decoration: none; transition: all 0.3s ease;"
                            onmouseover="this.style.background='#4267B2'; this.style.borderColor='#4267B2';"
                            onmouseout="this.style.background='rgba(255,255,255,0.05)'; this.style.borderColor='rgba(255,255,255,0.1)';">
                            <i class="fab fa-facebook-f" style="font-size: 20px;"></i>
                        </a>
                        <a href="#"
                            style="width: 50px; height: 50px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; text-decoration: none; transition: all 0.3s ease;"
                            onmouseover="this.style.background='linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888)'; this.style.borderColor='#dc2743';"
                            onmouseout="this.style.background='rgba(255,255,255,0.05)'; this.style.borderColor='rgba(255,255,255,0.1)';">
                            <i class="fab fa-instagram" style="font-size: 20px;"></i>
                        </a>
                        <a href="<?php echo $li; ?>"
                            style="width: 50px; height: 50px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; text-decoration: none; transition: all 0.3s ease;"
                            onmouseover="this.style.background='#0A66C2'; this.style.borderColor='#0A66C2';"
                            onmouseout="this.style.background='rgba(255,255,255,0.05)'; this.style.borderColor='rgba(255,255,255,0.1)';">
                            <i class="fab fa-linkedin-in" style="font-size: 20px;"></i>
                        </a>
                        <a href="https://wa.me/221778888888" target="_blank"
                            style="width: 50px; height: 50px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; text-decoration: none; transition: all 0.3s ease;"
                            onmouseover="this.style.background='#25D366'; this.style.borderColor='#25D366';"
                            onmouseout="this.style.background='rgba(255,255,255,0.05)'; this.style.borderColor='rgba(255,255,255,0.1)';">
                            <i class="fab fa-whatsapp" style="font-size: 20px;"></i>
                        </a>
                    </div>
                </div>
            </div>

            <style>
                .contact-card:hover {
                    transform: translateY(-10px);
                    border-color: rgba(106, 76, 147, 0.3);
                    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
                }

                .contact-card a:hover {
                    transform: translateX(5px);
                }
            </style>
        </section>
        <!--Contact Info Section End-->

<?php include 'includes/footer.php'; ?>
