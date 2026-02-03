<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Preferences & Reservation Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Lora:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <style>
        :root {
            --bg-dark: #0f1d24;
            --card-blue: #1a3a4a;
            --input-deep: #1a4f66;
            --accent-gold: #e2c275;
            --text-light: #f8dd9d;
            --btn-white: #ffffff;
            --danger: #ef4444;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Lora', serif;
            background-color: var(--bg-dark);
            background-image: linear-gradient(rgba(15, 29, 36, 0.8), rgba(15, 29, 36, 0.8)),
                url('https://media.istockphoto.com/id/1170342049/id/foto/pemandangan-populer-di-meja-makanan-restoran-mewah-dengan-makanan-lezat-makanan-berbaring.jpg?s=612x612&w=0&k=20&c=-DsnPg6I2ciScCM3bkDk671muN3f-BpNkMzr4u8kdRQ='),
                radial-gradient(circle at top right, #1a3a4a 0%, #0c161b 100%);
            background-attachment: fixed;
            background-size: cover;
            background-position: center;
            color: var(--text-light);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
        }

        .outer-frame {
            background-color: #0c161b;
            padding: 12px;
            border: 1px solid rgba(226, 194, 117, 0.2);
            box-shadow: 0 20px 60px rgba(0,0,0,0.7);
            width: 100%; max-width: 500px;
            border-radius: 2px;
        }

        .reservation-container {
            background-color: var(--card-blue);
            border: 4px double var(--accent-gold);
            border-radius: 2px;
            overflow: hidden;
            position: relative;
        }

        .header {
            padding: 30px 20px;
            text-align: center;
            border-bottom: 2px solid var(--accent-gold);
            position: relative;
        }

        .header h2 { font-family: 'Playfair Display', serif; color: var(--accent-gold); font-size: 1.5rem; }

        .form-content { padding: 25px; }

        .form-group-card {
            background-color: var(--input-deep);
            padding: 18px;
            margin-bottom: 20px;
            border-radius: 4px;
            border: 1px solid rgba(226, 194, 117, 0.5);
        }

        label {
            display: block;
            color: var(--accent-gold);
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
        }

        input, select, textarea {
            width: 100%; padding: 12px;
            border: 1px solid #2d4a58;
            border-radius: 4px;
            background-color: #fff;
            color: #333;
            font-family: 'Lora', serif;
        }

        #otherOccasionContainer {
            margin-top: 15px;
            display: none;
            border-top: 1px solid rgba(226, 194, 117, 0.3);
            padding-top: 15px;
        }

        .activity-controls { display: flex; gap: 8px; margin-bottom: 15px; }
        .btn-add {
            background: var(--accent-gold);
            color: var(--bg-dark);
            border: none; padding: 0 15px;
            border-radius: 4px; cursor: pointer; font-weight: bold;
        }

        .activity-list { list-style: none; }
        .activity-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(255,255,255,0.05);
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 8px;
            border-left: 3px solid var(--accent-gold);
        }

        .menu-item { border-left: 3px solid #ffffff; background: rgba(255,255,255,0.1); }
        .btn-remove { background: none; border: none; color: var(--danger); cursor: pointer; }

        .total-section {
            border-top: 1px solid rgba(226, 194, 117, 0.3);
            padding-top: 15px; margin-top: 10px;
            display: flex; justify-content: space-between;
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem; color: var(--accent-gold);
        }

        .form-footer { background-color: var(--input-deep); padding: 25px; border-top: 4px double var(--accent-gold); }

        .btn-submit {
            width: 100%; padding: 15px;
            background-color: var(--btn-white);
            color: var(--bg-dark);
            border: none; border-radius: 4px;
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem; font-weight: bold;
            cursor: pointer; transition: 0.3s;
        }
        .btn-submit:hover { background-color: var(--accent-gold); }

        /* MODAL STYLES */
        .modal-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.85); display: flex; justify-content: center; align-items: center;
            z-index: 1000; opacity: 0; visibility: hidden; transition: 0.3s;
        }
        .modal-overlay.active { opacity: 1; visibility: visible; }
        .modal { background: var(--card-blue); padding: 40px; border: 2px solid var(--accent-gold); text-align: center; max-width: 400px; border-radius: 4px; }
        
        .btn-modal-action {
            padding: 12px 25px; cursor: pointer; border-radius: 4px; font-weight: bold;
            background: transparent; color: var(--accent-gold); border: 2px solid var(--accent-gold);
            transition: 0.2s;
        }
        .btn-modal-action.selected { background-color: #fff; color: #000; border-color: #fff; box-shadow: 0 0 15px #fff; }

        .loading-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: var(--bg-dark); display: none; flex-direction: column;
            justify-content: center; align-items: center; z-index: 2000;
        }
        .spinner {
            width: 50px; height: 50px;
            border: 5px solid rgba(226, 194, 117, 0.3);
            border-top-color: var(--accent-gold);
            border-radius: 50%;
            animation: spin 1s ease-in-out infinite;
            margin-bottom: 20px;
        }
        @keyframes spin { to { transform: rotate(360deg); } }
        .loading-text {
            color: var(--accent-gold); font-family: 'Playfair Display', serif;
            font-size: 1.2rem; letter-spacing: 2px;
            animation: pulse 1.5s infinite;
        }
        @keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.5; } }
    </style>
</head>
<body>

<div id="loadingScreen" class="loading-overlay">
    <div class="spinner"></div>
    <div class="loading-text">Progressing your order...</div>
</div>



<div class="outer-frame">
    <div class="reservation-container">
        <header class="header">
            <h2>Preferences & Reservation</h2>
        </header>

        <form id="reservationForm">
            @csrf
            {{-- Data JSON gabungan (Cart + Additional Services) --}}
            <input type="hidden" name="activities_data" id="activitiesDataInput">

            <div class="form-content">
                {{-- Nama --}}
                <div class="form-group-card">
                    <label>Name under reservation:</label>
                    <input type="text" name="name" placeholder="Enter full name" required />
                </div>

                {{-- Tanggal & Waktu --}}
                <div class="form-group-card">
                    <div style="display:flex; gap:10px;">
                        <div style="flex:1;">
                            <label>Date:</label>
                            <input type="date" name="date" required />
                        </div>
                        <div style="flex:1;">
                            <label>Time:</label>
                            <input type="time" name="time" required />
                        </div>
                    </div>
                </div>

                {{-- Occasion & Location --}}
                <div class="form-group-card">
                    <div style="display:flex; flex-direction:column; gap:10px;">
                        <div style="display:flex; gap:10px;">
                            <div style="flex:1;">
                                <label>Occasion:</label>
                                <select name="occasion" id="occasionSelect" required>
                                    <option value="" disabled selected>Select</option>
                                    <option value="Dinner">Dinner</option>
                                    <option value="Birthday">Birthday</option>
                                    <option value="Anniversary">Anniversary</option>
                                    <option value="Wedding">Wedding</option>
                                    <option value="Corporate">Corporate</option>
                                    <option value="others">Others (Specify below)</option>
                                </select>
                            </div>
                            <div style="flex:1;">
                                <label>Location:</label>
                                <input type="text" name="location" placeholder="e.g. Hall A" required />
                            </div>
                        </div>

                        {{-- Specify Others --}}
                        <div id="otherOccasionContainer">
                            <label>Specify Occasion:</label>
                            <input type="text" name="other_occasion" id="otherOccasionInput" placeholder="Enter your occasion details...">
                        </div>
                    </div>
                </div>

                {{-- List Orders & Layanan Tambahan --}}
                <div class="form-group-card">
                    <label>Your Orders & Activities:</label>
                    
                    {{-- Item dari Cart Database --}}
                    <ul class="activity-list" id="menuDatabaseList">
                        @foreach($cart as $item)
                        <li class="activity-item menu-item">
                            <div>
                                <div style="font-weight: 600;">{{ $item['name'] }}</div>
                                <div style="font-size: 0.75rem; opacity: 0.8;">{{ $item['qty'] }} x Rp {{ number_format($item['price'], 0, ',', '.') }}</div>
                            </div>
                            <span style="font-weight:600;">Rp {{ number_format($item['qty'] * $item['price'], 0, ',', '.') }}</span>
                        </li>
                        @endforeach
                    </ul>

                    <hr style="border: 0; border-top: 1px dashed rgba(226,194,117,0.3); margin: 15px 0;">

                    {{-- Kontrol Layanan Tambahan --}}
                    <div class="activity-controls">
                        <select id="activitySelect" style="flex: 2;">
                            <option value="0" disabled selected>Tambah Layanan (Opsional)</option>
                            <option value="75000">Decoration - Rp 75.000</option>
                            <option value="100000">Buffet Extra - Rp 100.000</option>
                            <option value="150000">Live Music - Rp 150.000</option>
                            <option value="300000">Private Room - Rp 300.000</option>
                            <option value="500000">Dinner Package - Rp 500.000</option>
                        </select>
                        <input type="number" id="activityQty" value="1" min="1" style="flex: 0.5;">
                        <button type="button" class="btn-add" id="btnAddActivity"><i class="fas fa-plus"></i></button>
                    </div>

                    {{-- List Layanan yang ditambahkan --}}
                    <ul class="activity-list" id="activityList"></ul>

                    <div class="total-section">
                        <span>Grand Total</span>
                        <span id="grandTotal">Rp {{ number_format($cartTotal, 0, ',', '.') }}</span>
                    </div>
                </div>

                {{-- Notes --}}
                <div class="form-group-card">
                    <label>Special Notes:</label>
                    <textarea name="notes" rows="2" placeholder="Dietary requirements or special requests..."></textarea>
                </div>
            </div>

            <div class="form-footer">
                <button type="submit" class="btn-submit" id="submitBtn">Confirm Reservation</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL KONFIRMASI --}}
<div class="modal-overlay" id="confirmModal">
    <div class="modal">
        <h3 style="color: var(--accent-gold); font-family: 'Playfair Display', serif;">Confirm Reservation</h3>
        <p style="margin:15px 0; color: #fff; font-size: 0.9rem;">Are you sure the order details and additional services are correct?</p>
        <div style="display:flex; gap:10px; justify-content:center; margin-top: 20px;">
            <button type="button" class="btn-modal-action" id="btnCancelConfirm">No, Review</button>
            <button type="button" class="btn-modal-action" id="btnFinalSubmit">Yes, Confirm</button>
        </div>
    </div>
</div>

<script>
    const STORE_URL = "{{ route('reservation.store') }}";
    const BASE_MENU_TOTAL = {{ $cartTotal }}; 
    
    // Ambil data awal dari PHP cart
    const menuDataFromDB = [
        @foreach($cart as $item)
        { name: "{{ $item['name'] }}", price: {{ $item['price'] }}, qty: {{ $item['qty'] }}, total: {{ $item['price'] * $item['qty'] }} },
        @endforeach
    ];

    const state = {
        activities: [],
        formatter: new Intl.NumberFormat("id-ID", { style: "currency", currency: "IDR", minimumFractionDigits: 0 })
    };

    // Elements
    const btnAdd = document.getElementById("btnAddActivity");
    const activitySelect = document.getElementById("activitySelect");
    const activityQty = document.getElementById("activityQty");
    const activityList = document.getElementById("activityList");
    const grandTotalEl = document.getElementById("grandTotal");
    const activitiesDataInput = document.getElementById("activitiesDataInput");
    const loadingScreen = document.getElementById("loadingScreen");
    const occasionSelect = document.getElementById("occasionSelect");
    const otherOccasionContainer = document.getElementById("otherOccasionContainer");
    const otherOccasionInput = document.getElementById("otherOccasionInput");
    const form = document.getElementById("reservationForm");
    const confirmModal = document.getElementById("confirmModal");
    const btnCancel = document.getElementById("btnCancelConfirm");
    const btnFinal = document.getElementById("btnFinalSubmit");

    // --- LOGIKA MUNCULKAN INPUT "OTHERS" ---
    occasionSelect.addEventListener("change", function() {
        if (this.value === "others") {
            otherOccasionContainer.style.display = "block";
            otherOccasionInput.setAttribute("required", "required");
            otherOccasionInput.focus();
        } else {
            otherOccasionContainer.style.display = "none";
            otherOccasionInput.removeAttribute("required");
            otherOccasionInput.value = "";
        }
    });

    // Jalankan pertama kali untuk set input hidden awal
    updateHiddenInput();

    // --- LOGIKA LAYANAN TAMBAHAN ---
    btnAdd.addEventListener("click", () => {
        const price = parseInt(activitySelect.value);
        const nameText = activitySelect.options[activitySelect.selectedIndex].text;
        const qty = parseInt(activityQty.value);
        if (price === 0 || isNaN(price)) return alert("Please select an additional service!");
        
        state.activities.push({
            id: Date.now(),
            name: nameText.split(" - ")[0],
            price: price,
            qty: qty,
            total: price * qty
        });
        renderActivities();
    });

    window.removeActivity = function(id) {
        state.activities = state.activities.filter(a => a.id !== id);
        renderActivities();
    }

    function renderActivities() {
        activityList.innerHTML = "";
        let additionalTotal = 0;
        state.activities.forEach(item => {
            additionalTotal += item.total;
            const li = document.createElement("li");
            li.className = "activity-item";
            li.innerHTML = `
                <div>
                    <div style="font-weight: 500;">${item.name}</div>
                    <div style="font-size: 0.75rem; opacity: 0.7;">${item.qty} x ${state.formatter.format(item.price)}</div>
                </div>
                <div style="display:flex; align-items:center; gap:10px;">
                    <span style="font-weight:600; color:var(--accent-gold);">${state.formatter.format(item.total)}</span>
                    <button type="button" class="btn-remove" onclick="removeActivity(${item.id})"><i class="fas fa-trash"></i></button>
                </div>
            `;
            activityList.appendChild(li);
        });
        const totalSemua = BASE_MENU_TOTAL + additionalTotal;
        grandTotalEl.textContent = state.formatter.format(totalSemua);
        updateHiddenInput();
    }

    function updateHiddenInput() {
        // Gabungkan menu dari DB dan layanan tambahan buatan user
        const combined = [...menuDataFromDB, ...state.activities];
        activitiesDataInput.value = JSON.stringify(combined);
    }

    // --- LOGIKA SUBMIT FORM ---
    form.addEventListener("submit", (e) => { 
        if(!form.checkValidity()) {
            form.reportValidity();
            return;
        }
        e.preventDefault(); 
        confirmModal.classList.add("active"); 
    });
    
    btnCancel.addEventListener("click", () => { 
        btnCancel.classList.add("selected"); 
        setTimeout(() => {
            confirmModal.classList.remove("active");
            btnCancel.classList.remove("selected");
        }, 200); 
    });

    btnFinal.addEventListener("click", async () => {
        btnFinal.classList.add("selected");
        confirmModal.classList.remove("active");
        loadingScreen.style.display = "flex";
        
        const formData = new FormData(form);
        
        // Penting: Ganti nilai occasion jika user pilih 'others'
        if(occasionSelect.value === 'others') {
            formData.set('occasion', otherOccasionInput.value);
        }

        try {
            const response = await fetch(STORE_URL, {
                method: 'POST',
                body: formData,
                headers: { 
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    'Accept': 'application/json'
                }
            });
            
            const res = await response.json();
            
            setTimeout(() => {
                if(res.success) {
                    window.location.href = res.redirect_url;
                } else {
                    loadingScreen.style.display = "none";
                    btnFinal.classList.remove("selected");
                    alert("Error: " + JSON.stringify(res.errors || res.message));
                }
            }, 1500);
        } catch (e) { 
            loadingScreen.style.display = "none";
            btnFinal.classList.remove("selected");
            alert("Connection failed. Please try again."); 
        }
    });
</script>
</body>
</html>