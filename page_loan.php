<?php
session_start();
$pageTitle = 'Oferty';
include('header.php');

function calculateMonthlyPayment($loanAmount, $interestRate, $loanTerm) {
    $monthlyRate = $interestRate / 12 / 100;
    $termInMonths = $loanTerm * 12;

    if ($monthlyRate == 0) {
        return $loanAmount / $termInMonths;
    }

    $monthlyPayment = $loanAmount * $monthlyRate / (1 - pow((1 + $monthlyRate), -$termInMonths));
    return $monthlyPayment;
}

function calculateTotalInterest($monthlyPayment, $loanTerm, $loanAmount) {
    $totalPayment = $monthlyPayment * $loanTerm * 12;
    return $totalPayment - $loanAmount;
}

$errorMsg = '';
$monthlyPayment = 0;
$loanAmount = 400000;
$totalInterest = 0;
$inputLoanAmount = 400000;
$inputOwnContributionPercentage = 20;
$inputLoanTerm = 30;
$inputInterestRate = 6.84;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $inputLoanAmount = $_POST['loanAmount'] ?? '';
    $inputOwnContributionPercentage = $_POST['ownContributionPercentage'] ?? '';
    $inputLoanTerm = $_POST['loanTerm'] ?? '';
    $inputInterestRate = $_POST['interestRate'] ?? '';

    if (
        $inputLoanAmount >= 50000 && $inputLoanAmount <= 8000000 &&
        $inputOwnContributionPercentage >= 10 && $inputOwnContributionPercentage <= 90 &&
        $inputLoanTerm >= 5 && $inputLoanTerm <= 35 &&
        $inputInterestRate >= 1 && $inputInterestRate <= 20.5
    ) {
        $ownContribution = ($inputLoanAmount * $inputOwnContributionPercentage) / 100;
        $loanAmount = $inputLoanAmount - $ownContribution;
        $monthlyPayment = calculateMonthlyPayment($loanAmount, $inputInterestRate, $inputLoanTerm);
        $totalInterest = calculateTotalInterest($monthlyPayment, $inputLoanTerm, $loanAmount);
    } else {
        $errorMsg = "Proszę wprowadzić prawidłowe wartości.";
        $loanAmount = 0;
        $totalInterest = 0;
    }
}
?>

<section class="container my-5">
    <h2 class="text-center mb-4">Kalkulator kredytu hipotecznego</h2>
    <?php if (!empty($errorMsg)): ?>
        <div class="alert alert-danger" role="alert">
            <?= $errorMsg ?>
        </div>
    <?php endif; ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="needs-validation" novalidate>
        <div class="row mb-3">
            <label for="loanAmount" class="col-sm-4 col-form-label">Kwota kredytu (zł):</label>
            <div class="col-sm-8">
                <input type="number" class="form-control" id="loanAmount" name="loanAmount" min="50000" max="8000000" value="<?= $inputLoanAmount ?>" required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="ownContributionPercentage" class="col-sm-4 col-form-label">Wkład własny (%):</label>
            <div class="col-sm-8">
                <input type="number" class="form-control" id="ownContributionPercentage" name="ownContributionPercentage" min="10" max="90" value="<?= $inputOwnContributionPercentage ?>" required>
                <small class="form-text text-muted fs-6">20% ceny nieruchomości to minimum wymagane przez większość banków.</small>
            </div>
        </div>
        <div class="row mb-3">
            <label for="loanTerm" class="col-sm-4 col-form-label">Okres kredytowania (lata):</label>
            <div class="col-sm-8">
                <input type="number" class="form-control" id="loanTerm" name="loanTerm" min="5" max="35" value="<?= $inputLoanTerm ?>" required>
                <small class="form-text text-muted fs-6">30 lat to najczęstszy wybór. Im krótszy okres, tym wyższa rata miesięczna.</small>
            </div>
        </div>
        <div class="row mb-3">
            <label for="interestRate" class="col-sm-4 col-form-label">Oprocentowanie (%):</label>
            <div class="col-sm-8">
                <input type="number" class="form-control" id="interestRate" name="interestRate" min="1" max="20.5" step="0.01" value="<?= $inputInterestRate ?>" required>
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Oblicz</button>
        </div>
    </form>

    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($errorMsg)): ?>
        <div class="results mt-4">
            <p class="fs-5">Rata miesięczna: <strong><?= number_format($monthlyPayment, 2) ?> zł</strong></p>
            <p class="fs-5">Kwota kredytu (po uwzględnieniu wkładu własnego): <strong><?= number_format($loanAmount, 2) ?> zł</strong></p>
            <p class="fs-5">Całkowite odsetki: <strong><?= number_format($totalInterest, 2) ?> zł</strong></p>
            <p class="fs-6">Kalkulator wylicza orientacyjną ratę Twojego kredytu. Zamów rozmowę z ekspertem, aby omówić szczegóły i poznać oferty banków.</p>

        </div>
    <?php endif; ?>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get references to the input fields and other elements for feedback
        var loanAmountInput = document.getElementById('loanAmount');
        var ownContributionInput = document.getElementById('ownContributionPercentage');
        var loanTermInput = document.getElementById('loanTerm');
        var interestRateInput = document.getElementById('interestRate');

        // Function to validate input values on fly
        function validateInput(input, minValue, maxValue) {
            var value = parseFloat(input.value);

            if (isNaN(value) || value < minValue || value > maxValue) {
                input.classList.add('is-invalid');
                input.nextElementSibling.innerHTML = 'Wartość powinna być między ' + minValue + ' a ' + maxValue + '.';
            } else {
                input.classList.remove('is-invalid');
                input.nextElementSibling.innerHTML = '';
            }
        }

        // Listen for input on each field to validate its value
        loanAmountInput.addEventListener('input', function () {
            validateInput(this, 50000, 8000000);
        });

        ownContributionInput.addEventListener('input', function () {
            validateInput(this, 10, 90);
        });

        loanTermInput.addEventListener('input', function () {
            validateInput(this, 5, 35);
        });

        interestRateInput.addEventListener('input', function () {
            validateInput(this, 1, 20.5);
        });
    });
</script>

<?php
include('footer.php');
?>