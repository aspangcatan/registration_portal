<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Portal</title>
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>

    <style>
        /* Tailwind + Select2 alignment */
        .select2-container .select2-selection--single {
            height: 2.75rem; /* match Tailwind input height */
            border-radius: 0.5rem;
            border: 1px solid #d1d5db; /* gray-300 */
            padding: 0.5rem;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 50%;
            transform: translateY(-50%);
            right: 0.75rem;
        }

        .required:after {
            content: " *";
            color: red;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200 p-4">

<div class="w-full max-w-4xl bg-white rounded-2xl shadow-xl p-8">
    <!-- Header -->
    <div class="text-center mb-6">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Create Your Account</h1>
        <p class="text-gray-500 text-sm">Fill in the details below to register</p>
    </div>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
@endif

<!-- Registration Form -->
    <form action="{{ route('storePendingUser') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
    @csrf

    <!-- Basic Information -->
        <div class="md:col-span-2 mt-4">
            <h2 class="text-lg font-semibold text-gray-800">Basic Information</h2>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 required">Firstname</label>
            <input type="text" name="firstname" value="{{ old('firstname') }}" required
                   class="mt-1 w-full px-4 py-2 rounded-lg border border-gray-300">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Middlename</label>
            <input type="text" name="middlename" value="{{ old('middlename') }}"
                   class="mt-1 w-full px-4 py-2 rounded-lg border border-gray-300">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 required">Lastname</label>
            <input type="text" name="lastname" value="{{ old('lastname') }}" required
                   class="mt-1 w-full px-4 py-2 rounded-lg border border-gray-300">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Suffix</label>
            <input type="text" name="suffix" value="{{ old('suffix') }}"
                   class="mt-1 w-full px-4 py-2 rounded-lg border border-gray-300">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 required">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                   class="mt-1 w-full px-4 py-2 rounded-lg border border-gray-300">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 required">Birthdate</label>
            <input type="date" name="birthdate" value="{{ old('birthdate') }}" required
                   class="mt-1 w-full px-4 py-2 rounded-lg border border-gray-300">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 required">Blood Type</label>
            <select name="blood_type" id="blood_type" required class="mt-1 w-full rounded-lg border border-gray-300">
                <option value="">Select Blood Type</option>
                @foreach(['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'] as $type)
                    <option value="{{ $type }}" {{ old('blood_type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 required">Mobile No.</label>
            <input type="text" name="mobile_no" value="{{ old('mobile_no') }}" required
                   class="mt-1 w-full px-4 py-2 rounded-lg border border-gray-300">
        </div>

        <!-- Government IDs -->
        <div>
            <label class="block text-sm font-medium text-gray-700 required">TIN</label>
            <input type="text" name="tin" value="{{ old('tin') }}" required
                   class="mt-1 w-full px-4 py-2 rounded-lg border border-gray-300">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 required">GSIS</label>
            <input type="text" name="gsis" value="{{ old('gsis') }}" required
                   class="mt-1 w-full px-4 py-2 rounded-lg border border-gray-300">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 required">PHILHEALTH</label>
            <input type="text" name="philhealth" value="{{ old('philhealth') }}" required
                   class="mt-1 w-full px-4 py-2 rounded-lg border border-gray-300">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 required">PAGIBIG</label>
            <input type="text" name="pagibig" value="{{ old('pagibig') }}" required
                   class="mt-1 w-full px-4 py-2 rounded-lg border border-gray-300">
        </div>

        <!-- Complete Address -->
        <div class="md:col-span-2 mt-4">
            <h2 class="text-lg font-semibold text-gray-800">Complete Address</h2>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">House No.</label>
            <input type="text" name="house_no" value="{{ old('house_no') }}"
                   class="mt-1 w-full px-4 py-2 rounded-lg border border-gray-300">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Street</label>
            <input type="text" name="street" value="{{ old('street') }}"
                   class="mt-1 w-full px-4 py-2 rounded-lg border border-gray-300">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Subdivision / Village</label>
            <input type="text" name="subdivision" value="{{ old('subdivision') }}"
                   class="mt-1 w-full px-4 py-2 rounded-lg border border-gray-300">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 required">Province</label>
            <select name="province" id="province" required class="mt-1 w-full rounded-lg border border-gray-300">
                <option value="">Select Province</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 required">City</label>
            <select name="city" id="city" required class="mt-1 w-full rounded-lg border border-gray-300">
                <option value="">Select City</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 required">Barangay</label>
            <select name="barangay" id="barangay" required class="mt-1 w-full rounded-lg border border-gray-300">
                <option value="">Select Barangay</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Zip Code</label>
            <input type="text" name="zip_code" value="{{ old('zip_code') }}"
                   class="mt-1 w-full px-4 py-2 rounded-lg border border-gray-300">
        </div>

        <!-- Emergency Contact -->
        <div class="md:col-span-2 mt-4">
            <h2 class="text-lg font-semibold text-gray-800">In Case of Emergency</h2>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 required">Contact Name</label>
            <input type="text" name="emergency_contact_name" value="{{ old('emergency_contact_name') }}" required
                   class="mt-1 w-full px-4 py-2 rounded-lg border border-gray-300">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 required">Contact No.</label>
            <input type="text" name="emergency_contact_no" value="{{ old('emergency_contact_no') }}" required
                   class="mt-1 w-full px-4 py-2 rounded-lg border border-gray-300">
        </div>
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 required">Contact Address</label>
            <input type="text" name="emergency_contact_address" value="{{ old('emergency_contact_address') }}" required
                   class="mt-1 w-full px-4 py-2 rounded-lg border border-gray-300">
        </div>

        <!-- Other Information -->
        <div class="md:col-span-2 mt-4">
            <h2 class="text-lg font-semibold text-gray-800">Other Information</h2>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 required">Designation</label>
            <select name="designation" id="designation" required class="mt-1 w-full rounded-lg border border-gray-300">
                <option value="">Select Designation</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 required">Employment Type</label>
            <select name="type" id="type" required class="mt-1 w-full rounded-lg border border-gray-300"
                    value="{{ old('type') }}">
                <option value="">Select Designation</option>
                <option>Job Order</option>
                <option>Permanent</option>
                <option>Temporary</option>
                <option>EOT</option>
                <option>COS</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 required">Division</label>
            <select name="division" id="division" required class="mt-1 w-full rounded-lg border border-gray-300">
                <option value="">Select Division</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 required">Department / Unit / Section</label>
            <select name="section" id="section" required class="mt-1 w-full rounded-lg border border-gray-300">
                <option value="">Select Section</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 required">Username</label>
            <input type="text" name="username" value="{{ old('username') }}" required
                   class="mt-1 w-full px-4 py-2 rounded-lg border border-gray-300">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 required">Password</label>
            <input type="password" name="password" required
                   class="mt-1 w-full px-4 py-2 rounded-lg border border-gray-300">
        </div>

        <!-- Data Privacy Consent -->
        <div class="md:col-span-2 mt-6">
            <label class="flex items-start space-x-2 text-sm text-gray-700">
                <input type="checkbox" name="privacy_consent" id="privacy_consent" required
                       class="mt-1 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                <span>
                    I have read and understood the
                    <button type="button" id="openPrivacy"
                            class="text-indigo-600 underline font-medium">
                        Data Privacy Notice
                    </button>
                    and consent to the collection, use, storage, and processing of my personal data.
                </span>
            </label>
        </div>

        <div class="md:col-span-2 mt-6">
            <button type="submit"
                    id="registerBtn"
                    disabled
                    class="w-full py-3 rounded-xl bg-indigo-400 cursor-not-allowed
               text-white font-semibold transition duration-300 ease-in-out">
                Register
            </button>
        </div>
    </form>

    <!-- Footer -->
    <p class="mt-6 text-center text-gray-500 text-sm">
        Already have an account?
        <a href="#" class="text-indigo-600 hover:underline">Login here</a>
    </p>
</div>

<!-- ================= DATA PRIVACY MODAL ================= -->
<div id="privacyModal"
     class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">

    <div class="bg-white w-full max-w-3xl rounded-xl shadow-lg p-6 overflow-y-auto max-h-[90vh]">
        <h2 class="text-xl font-semibold mb-4 text-gray-800">
            Data Privacy Notice
        </h2>

        <div class="text-sm text-gray-700 space-y-4 leading-relaxed">

            <p>
                The <strong>CSMC Document Tracking System (DTS)</strong> is a digital system used to record,
                monitor, and manage the movement and status of documents within CSMC.
                This system is committed to protecting the privacy and security of personal
                data in compliance with applicable data privacy laws and regulations.
            </p>

            <p class="font-semibold">1. Personal Data Collected</p>
            <ul class="list-disc pl-6">
                <li>Full name</li>
                <li>Employee ID number</li>
                <li>Position and department</li>
                <li>Official email address</li>
                <li>Birthdate</li>
                <li>Blood Type</li>
                <li>Contact Information</li>
                <li>TIN</li>
                <li>GSIS</li>
                <li>PHILHEALTH</li>
                <li>PAGIBIG</li>
                <li>Address Information</li>
                <li>In Case of Emergency Information</li>
            </ul>

            <p class="font-semibold">2. Purpose of Data Collection and Use</p>
            <p>Personal data shall only be processed for legitimate organizational and administrative purposes. The
                following purposes apply:</p>
            <ul class="list-disc pl-6">
                <li>
                    <strong>Primary Purpose:</strong>
                    To create and manage the employee’s DTS account and support HRIS functions.
                </li>
                <li>
                    <strong>Secondary Purpose:</strong>
                    To integrate with internal systems including Learning and Development.
                </li>
            </ul>

            <p class="font-semibold">3. Data Storage</p>
            <p>
                All collected personal data shall be securely stored in the CSMC in-house server with appropriate
                technical and organizational safeguards in place to prevent unauthorized access, loss, or misuse.
            </p>

            <p class="font-semibold">4. Data Access</p>
            <p>Access to personal data is strictly limited to:</p>
            <ul class="list-disc pl-6">
                <li>HRMO Focal Person</li>
                <li>Assigned IT Personnel</li>
            </ul>
            <p>
                These authorized individuals are bound by confidentiality obligations and are permitted access only for
                official and system-related purposes.
            </p>

            <p class="font-semibold">5. Data Retention</p>
            <p>
                Personal data shall be retained only for as long as necessary to fulfill the purposes stated above or as
                required by applicable laws, rules, and institutional policies.
            </p>
            <p class="font-semibold">6. Data Security Measures</p>
            <p>
                CSMC implements reasonable administrative, technical, and physical security measures to protect personal
                data against unauthorized access, alteration, disclosure, or destruction.
            </p>
            <p class="font-semibold">7. Data Subject Rights</p>
            <p>
                Employees have the right to:
            </p>
            <ul class="list-disc pl-6">
                <li>Be informed about the processing of their personal data</li>
                <li>Access and review their personal data</li>
                <li>Raise concerns regarding data privacy and protection</li>
            </ul>

            <p class="font-semibold">8. Consent</p>
            <p>
                By providing personal data for the CSMC Document Tracking System, you acknowledge that you have read and
                understood this Data Privacy Notice and consent to the collection, use, storage, and processing of you
                personal data as described herein.
            </p>
        </div>

        <div class="mt-6 flex justify-end">
            <button type="button" id="closePrivacy"
                    class="px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">
                Close
            </button>
        </div>
    </div>
</div>


<!-- JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    let dropdownData = {};

    $(document).ready(function () {
        // Enable/disable Register button based on consent checkbox
        $('#privacy_consent').on('change', function () {
            if ($(this).is(':checked')) {
                $('#registerBtn')
                    .prop('disabled', false)
                    .removeClass('bg-indigo-400 cursor-not-allowed')
                    .addClass('bg-indigo-600 hover:bg-indigo-700');
            } else {
                $('#registerBtn')
                    .prop('disabled', true)
                    .removeClass('bg-indigo-600 hover:bg-indigo-700')
                    .addClass('bg-indigo-400 cursor-not-allowed');
            }
        });

        // Existing modal logic
        $('#openPrivacy').on('click', function () {
            $('#privacyModal').removeClass('hidden').addClass('flex');
        });

        $('#closePrivacy').on('click', function () {
            $('#privacyModal').addClass('hidden').removeClass('flex');
        });
        // Enhance dropdowns with Select2
        $('#designation, #division, #section, #blood_type, #province, #city, #barangay, #type').select2({
            width: '100%',
            placeholder: "Select an option",
            allowClear: true
        });

        // Fetch provinces
        fetch("{{ route('getProvinces') }}")
            .then(res => res.json())
            .then(data => {
                data.forEach(item => {
                    let selected = "{{ old('province') }}" == item.provCode ? "selected" : "";
                    $('#province').append(`<option value="${item.provCode}" ${selected}>${item.provDesc}</option>`);
                });
                $('#province').trigger('change');
            });

        // Province ? Cities
        $('#province').on('change', function () {
            let provCode = $(this).val();
            $('#city').empty().append('<option value="">Select City</option>');
            $('#barangay').empty().append('<option value="">Select Barangay</option>');

            if (provCode) {
                fetch("{{ url('/address/cities') }}/" + provCode)
                    .then(res => res.json())
                    .then(data => {
                        data.forEach(item => {
                            let selected = "{{ old('city') }}" == item.citymunCode ? "selected" : "";
                            $('#city').append(`<option value="${item.citymunCode}" ${selected}>${item.citymunDesc}</option>`);
                        });
                        $('#city').trigger('change');
                    });
            }
        });

        // City ? Barangays
        $('#city').on('change', function () {
            let citymunCode = $(this).val();
            $('#barangay').empty().append('<option value="">Select Barangay</option>');

            if (citymunCode) {
                fetch("{{ url('/address/barangays') }}/" + citymunCode)
                    .then(res => res.json())
                    .then(data => {
                        data.forEach(item => {
                            let selected = "{{ old('barangay') }}" == item.brgyCode ? "selected" : "";
                            $('#barangay').append(`<option value="${item.brgyCode}" ${selected}>${item.brgyDesc}</option>`);
                        });
                    });
            }
        });

        // Fetch dropdown data for designation, division, section
        fetch("{{ route('getDropDownData') }}")
            .then(response => response.json())
            .then(data => {
                dropdownData = data;

                // Populate Designation
                $.each(data.designations, function (i, item) {
                    let selected = "{{ old('designation') }}" == item.id ? "selected" : "";
                    $('#designation').append(`<option value="${item.id}" ${selected}>${item.description}</option>`);
                });

                // Populate Division
                $.each(data.divisions, function (i, item) {
                    let selected = "{{ old('division') }}" == item.id ? "selected" : "";
                    $('#division').append(`<option value="${item.id}" ${selected}>${item.description}</option>`);
                });

                $('#designation, #division').trigger('change');
            });

        // When Division changes ? filter Sections
        $('#division').on('change', function () {
            const divisionId = $(this).val();
            $('#section').empty().append('<option value="">Select Section</option>');

            if (divisionId) {
                const filteredSections = dropdownData.sections.filter(s => s.division == divisionId);
                $.each(filteredSections, function (i, item) {
                    let selected = "{{ old('section') }}" == item.id ? "selected" : "";
                    $('#section').append(`<option value="${item.id}" ${selected}>${item.description}</option>`);
                });
            }

            $('#section').trigger('change');
        });
    });
</script>
</body>
</html>
