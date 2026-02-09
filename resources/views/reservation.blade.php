<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Preferences & Reservation Details</title>
    
    {{-- SDK Midtrans Sandbox --}}
    <script type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    
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
                url('https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80');
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
            width: 100%; max-width: 600px;
            border-radius: 2px;
        }

        .reservation-container {
            background-color: var(--card-blue);
            border: 4px double var(--accent-gold);
            border-radius: 2px;
            overflow: hidden;
        }

        .header {
            padding: 30px 20px;
            text-align: center;
            border-bottom: 2px solid var(--accent-gold);
        }

        .header h2 { font-family: 'Playfair Display', serif; color: var(--accent-gold); font-size: 1.5rem; letter-spacing: 2px;}

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
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }

        input, select, textarea {
            width: 100%; padding: 12px;
            border: 1px solid #2d4a58;
            border-radius: 4px;
            background-color: #fff;
            color: #333;
            font-family: 'Lora', serif;
        }

        /* Payment Options */
        .payment-options {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-top: 5px;
        }

        .pay-card {
            border: 1px solid rgba(226, 194, 117, 0.3);
            background: rgba(0,0,0,0.2);
            padding: 12px;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            transition: 0.3s;
        }

        .pay-card input { display: none; }
        .pay-card i { font-size: 1.2rem; display: block; margin-bottom: 5px; opacity: 0.6; }
        .pay-card span { font-size: 10px; text-transform: uppercase; font-weight: bold; }

        .pay-card:has(input:checked) {
            background: var(--accent-gold);
            color: var(--bg-dark);
        }

        /* Activity Lists */
        .activity-list { list-style: none; }
        .activity-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(255,255,255,0.05);
            padding: 10px 12px;
            border-radius: 4px;
            margin-bottom: 8px;
            border-left: 3px solid var(--accent-gold);
        }

        .activity-controls { display: flex; gap: 8px; margin-bottom: 15px; }

        .btn-add { 
            background: var(--accent-gold); 
            border: none; padding: 0 15px; 
            border-radius: 4px; cursor: pointer; 
            color: var(--bg-dark);
        }

        .btn-remove { color: var(--danger); cursor: pointer; background: none; border: none; font-size: 0.8rem; margin-left: 10px; }

        .total-section {
            border-top: 1px solid rgba(226, 194, 117, 0.3);
            padding-top: 15px; margin-top: 10px;
            display: flex; justify-content: space-between;
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem; color: var(--accent-gold);
        }

        .btn-submit {
            width: 100%; padding: 18px;
            background-color: var(--btn-white);
            color: var(--bg-dark);
            border: none; border-radius: 4px;
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem; font-weight: bold;
            cursor: pointer; transition: 0.3s;
        }

        .btn-submit:hover { background-color: var(--accent-gold); }

        #otherOccasionContainer { display: none; margin-top: 15px; }

        /* Loading & Modals */
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
            animation: spin 1s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        .modal-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.85); display: none; justify-content: center; align-items: center;
            z-index: 1000;
        }
        .modal-overlay.active { display: flex; }
        .modal { background: var(--card-blue); padding: 30px; border: 2px solid var(--accent-gold); text-align: center; max-width: 400px; }
    </style>
</head>
<body>

<div id="loadingScreen" class="loading-overlay">
    <div class="spinner"></div>
    <div class="loading-text" style="color:var(--accent-gold); margin-top:20px;">Processing Reservation...</div>
</div>

<div class="outer-frame">
    <div class="reservation-container">
        <header class="header">
            <h2>RESERVATION DETAILS</h2>
        </header>

        <form id="reservationForm">
            @csrf
            <input type="hidden" name="activities_data" id="activitiesDataInput">

            <div class="form-content">
                {{-- Personal Info --}}
                <div class="form-group-card">
                    <label>Name under reservation:</label>
                    <input type="text" name="name" placeholder="Enter full name" required />
                </div>

                {{-- Date & Time --}}
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
                        <div id="otherOccasionContainer">
                            <label>Specify Occasion:</label>
                            <input type="text" name="other_occasion" id="otherOccasionInput" placeholder="Enter your occasion details...">
                        </div>
                    </div>
                </div>

                {{-- Payment Method --}}
                <div class="form-group-card">
                    <label>Payment Method</label>
                    <div class="payment-options">
                        <label class="pay-card">
                            <input type="radio" name="payment_method" value="midtrans" checked>
                            <i class="fas fa-credit-card"></i>
                            <span>Online Payment</span>
                        </label>
                        <label class="pay-card">
                            <input type="radio" name="payment_method" value="cod">
                            <i class="fas fa-hand-holding-usd"></i>
                            <span>Pay at Spot</span>
                        </label>
                    </div>
                </div>

                {{-- Orders & Activities --}}
                <div class="form-group-card">
                    <label>Your Orders & Activities:</label>
                    <ul class="activity-list" id="menuDatabaseList">
                        @foreach($cart as $item)
                        <li class="activity-item">
                            <div>
                                <div style="font-weight: 600;">{{ $item['name'] }}</div>
                                <div style="font-size: 0.75rem; opacity: 0.8;">{{ $item['qty'] }} x Rp {{ number_format($item['price'], 0, ',', '.') }}</div>
                            </div>
                            <span style="font-weight:600;">Rp {{ number_format($item['qty'] * $item['price'], 0, ',', '.') }}</span>
                        </li>
                        @endforeach
                    </ul>

                    <hr style="border: 0; border-top: 1px dashed rgba(226,194,117,0.3); margin: 15px 0;">

                    <div class="activity-controls">
                        <select id="activitySelectField" style="flex: 2;">
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

                    <ul class="activity-list" id="extraActivityList"></ul>

                    <div class="total-section">
                        <span>Grand Total</span>
                        <span id="grandTotal">Rp {{ number_format($cartTotal, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="form-group-card">
                    <label>Special Notes:</label>
                    <textarea name="notes" rows="2" placeholder="Dietary requirements or special requests..."></textarea>
                </div>
            </div>

            <div class="form-footer" style="padding: 25px; background: var(--input-deep);">
                <button type="submit" class="btn-submit" id="submitBtn">Confirm Reservation</button>
            </div>
        </form>
    </div>
</div>

{{-- Confirmation Modal --}}
<div class="modal-overlay" id="confirmModal">
    <div class="modal">
        <h3 style="color: var(--accent-gold); margin-bottom:10px;">Finalize Order?</h3>
        <p style="color:#fff; font-size:0.9rem; margin-bottom:20px;">Confirm your details before proceeding to payment.</p>
        <div style="display:flex; gap:10px; justify-content:center;">
            <button type="button" onclick="toggleModal(false)" style="background:none; color:#fff; border:1px solid #fff; padding:10px 20px; cursor:pointer;">Review</button>
            <button type="button" id="btnFinalSubmit" style="background:var(--accent-gold); color:#000; border:none; padding:10px 20px; cursor:pointer; font-weight:bold;">Submit</button>
        </div>
    </div>
</div>

<script>
    const STORE_URL = "{{ route('reservation.store') }}";
    const BASE_TOTAL = {{ $cartTotal }};
    const menuDataDB = [
        @foreach($cart as $item)
        { name: "{{ $item['name'] }}", price: {{ $item['price'] }}, qty: {{ $item['qty'] }}, total: {{ $item['price'] * $item['qty'] }} },
        @endforeach
    ];

    const state = {
        extras: [],
        formatter: new Intl.NumberFormat("id-ID", { style: "currency", currency: "IDR", minimumFractionDigits: 0 })
    };

    const form = document.getElementById("reservationForm");
    const extraList = document.getElementById("extraActivityList");
    const grandTotalEl = document.getElementById("grandTotal");
    const activitiesInput = document.getElementById("activitiesDataInput");
    const loading = document.getElementById("loadingScreen");
    const modal = document.getElementById("confirmModal");
    const occasionSelect = document.getElementById("occasionSelect");
    const otherContainer = document.getElementById("otherOccasionContainer");

    // Handle Occasion "Others"
    occasionSelect.addEventListener("change", (e) => {
        otherContainer.style.display = e.target.value === "others" ? "block" : "none";
    });

    // Add Service Logic
    document.getElementById("btnAddActivity").addEventListener("click", () => {
        const select = document.getElementById("activitySelectField");
        const qtyInput = document.getElementById("activityQty");
        const price = parseInt(select.value);
        const qty = parseInt(qtyInput.value);

        if(!price || qty < 1) return;
        
        state.extras.push({
            id: Date.now(),
            name: select.options[select.selectedIndex].text.split(" - ")[0],
            price: price,
            qty: qty,
            total: price * qty
        });
        
        qtyInput.value = 1; // reset qty
        render();
    });

    window.removeExtra = function(id) {
        state.extras = state.extras.filter(item => item.id !== id);
        render();
    };

    function render() {
        extraList.innerHTML = "";
        let extraTotal = 0;
        state.extras.forEach(a => {
            extraTotal += a.total;
            const li = document.createElement("li");
            li.className = "activity-item";
            li.innerHTML = `
                <div>
                    <div style="font-weight: 600;">${a.name}</div>
                    <div style="font-size: 0.75rem; opacity: 0.8;">${a.qty} x ${state.formatter.format(a.price)}</div>
                </div>
                <span style="font-weight:600;">
                    ${state.formatter.format(a.total)} 
                    <button type="button" class="btn-remove" onclick="removeExtra(${a.id})"><i class="fas fa-times"></i></button>
                </span>`;
            extraList.appendChild(li);
        });
        grandTotalEl.textContent = state.formatter.format(BASE_TOTAL + extraTotal);
        activitiesInput.value = JSON.stringify([...menuDataDB, ...state.extras]);
    }

    function toggleModal(show) {
        modal.classList.toggle('active', show);
    }

    form.addEventListener("submit", (e) => {
        e.preventDefault();
        toggleModal(true);
    });

    document.getElementById("btnFinalSubmit").addEventListener("click", async () => {
        toggleModal(false);
        loading.style.display = "flex";

        const formData = new FormData(form);
        const paymentMethod = formData.get('payment_method');

        try {
            const response = await fetch(STORE_URL, {
                method: 'POST',
                body: formData,
                headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}", 'Accept': 'application/json' }
            });
            const res = await response.json();

            if (res.success) {
                if (paymentMethod === 'midtrans' && res.snap_token) {
                    loading.style.display = "none";
                    window.snap.pay(res.snap_token, {
                        onSuccess: (r) => window.location.href = res.redirect_url,
                        onPending: (r) => window.location.href = res.redirect_url,
                        onClose: () => {
                            loading.style.display = "none";
                            alert("Payment Window Closed");
                        }
                    });
                } else {
                    window.location.href = res.redirect_url;
                }
            } else {
                throw new Error(res.message || "Failed to process");
            }
        } catch (e) {
            loading.style.display = "none";
            alert("Error: " + e.message);
        }
    });

    // Initial value for hidden input
    activitiesInput.value = JSON.stringify(menuDataDB);
</script>

</body>
</html>