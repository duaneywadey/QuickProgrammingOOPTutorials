<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AlpineJS Bootstrap Forms - Fixed Promises</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body>
<div class="container mt-5" x-data="formsApp()">
    <h2 class="mb-4">Forms App</h2>
    
    <!-- Greeting Form -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>User Greeting</h5>
        </div>
        <div class="card-body">
            <form @submit.prevent="submitForm('greetUserWithNameAndAge')" class="form-row">
                <div class="form-group col-md-5">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" x-model="name">
                </div>
                <div class="form-group col-md-5">
                    <label for="age">Age:</label>
                    <input type="number" class="form-control" id="age" x-model="age">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary mt-4">Greet</button>
                </div>
            </form>
            <div class="mt-3" x-show="greetingResult" x-text="greetingResult" class="alert alert-success"></div>
        </div>
    </div>

    <!-- Product Form -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Product Calculator</h5>
        </div>
        <div class="card-body">
            <form @submit.prevent="submitForm('getProduct')" class="form-row">
                <div class="form-group col-md-5">
                    <label for="num1">Number 1:</label>
                    <input type="number" class="form-control" id="num1" x-model="num1">
                </div>
                <div class="form-group col-md-5">
                    <label for="num2">Number 2:</label>
                    <input type="number" class="form-control" id="num2" x-model="num2">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-success mt-4">Calculate</button>
                </div>
            </form>
            <div class="mt-3" x-show="productResult" x-text="productResult" class="alert alert-success"></div>
        </div>
    </div>

    <!-- Quotient Form -->
    <div class="card">
        <div class="card-header">
            <h5>Quotient Calculator</h5>
        </div>
        <div class="card-body">
            <form @submit.prevent="submitForm('getQuotient')" class="form-row">
                <div class="form-group col-md-5">
                    <label for="dividend">Dividend:</label>
                    <input type="number" class="form-control" id="dividend" x-model="dividend">
                </div>
                <div class="form-group col-md-5">
                    <label for="divisor">Divisor:</label>
                    <input type="number" class="form-control" id="divisor" x-model="divisor">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-info mt-4">Divide</button>
                </div>
            </form>
            <div class="mt-3" x-show="quotientResult" x-text="quotientResult" class="alert alert-success"></div>
            <div class="mt-3" x-show="errorMsg" x-text="errorMsg" class="alert alert-danger"></div>
        </div>
    </div>
</div>

<script>
function formsApp() {
    return {
        name: '',
        age: '',
        num1: '',
        num2: '',
        dividend: '',
        divisor: '',
        greetingResult: '',
        productResult: '',
        quotientResult: '',
        errorMsg: '',

        clearResults() {
            this.greetingResult = '';
            this.productResult = '';
            this.quotientResult = '';
            this.errorMsg = '';
        },

        submitForm(action) {
            this.clearResults();
            
            let payload = { action };
            
            if (action === 'greetUserWithNameAndAge') {
                payload.name = this.name;
                payload.age = this.age;
            } else if (action === 'getProduct') {
                payload.num1 = parseFloat(this.num1);
                payload.num2 = parseFloat(this.num2);
            } else if (action === 'getQuotient') {
                payload.dividend = parseFloat(this.dividend);
                payload.divisor = parseFloat(this.divisor);
            }

            fetch('handleForms.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(payload)
            })
            .then(response => response.json())  // Always parse JSON first
            .then(result => {
                if (result.success) {
                    if (action === 'greetUserWithNameAndAge') {
                        this.greetingResult = result.message;
                    } else if (action === 'getProduct') {
                        this.productResult = result.message;
                    } else if (action === 'getQuotient') {
                        this.quotientResult = result.message;
                    }
                } else {
                    this.errorMsg = result.error || 'An error occurred';
                }
            })
            .catch(error => {
                this.errorMsg = 'Network error occurred: ' + error.message;
            });
        }
    }
}
</script>
</body>
</html>
