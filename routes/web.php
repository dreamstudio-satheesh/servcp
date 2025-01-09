<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



//Route::domain('{subdomain}.servcp.com')->group(function () {


    Route::get('/', function () {
        return redirect('home');
    });

    Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');


    // Roles
    Route::get('/roles', App\Livewire\Master\RoleManager::class)->name('roles');

    // Device Companies
    Route::get('/device-companies', App\Livewire\Master\DeviceCompanyManager::class)->name('device-companies');

    // Device Colors
    Route::get('/device-colors', App\Livewire\Master\DeviceColorManager::class)->name('device-colors');

    // Device Physical Conditions
    Route::get('/device-physical-conditions', App\Livewire\Master\DevicePhysicalConditionManager::class)->name('device-physical-conditions');

    // Device Accessories
    Route::get('/device-accessories', App\Livewire\Master\DeviceAccessoryManager::class)->name('device-accessories');

    // Service Complaints
    Route::get('/service-complaints', App\Livewire\Master\ServiceComplaintManager::class)->name('service-complaints');

    // Complaint and Estimates
    Route::get('/complaint-estimates', App\Livewire\Master\ComplaintEstimateManager::class)->name('complaint-estimates');

    // Initial Checks
    Route::get('/initial-checks', App\Livewire\Master\InitialCheckManager::class)->name('initial-checks');

    // Service Reports
    Route::get('/service-reports', App\Livewire\Master\ServiceReportManager::class)->name('service-reports');

    // Printable Reports
    Route::get('/printable-reports', App\Livewire\Master\PrintableReportManager::class)->name('printable-reports');

    // Risk Agreements
    Route::get('/risk-agreements', App\Livewire\Master\RiskAgreementManager::class)->name('risk-agreements');

    // Store Item Categories
    Route::get('/store-item-categories', App\Livewire\Master\StoreItemCategoryManager::class)->name('store-item-categories');

    // Quality Checks
    Route::get('/quality-checks', App\Livewire\Master\QualityCheckManager::class)->name('quality-checks');

    // Currencies
    Route::get('/currencies', App\Livewire\Master\CurrencyManager::class)->name('currencies');

    // Print Sizes
    Route::get('/print-sizes', App\Livewire\Master\PrintSizeManager::class)->name('print-sizes');

    // Device Models
    Route::get('/device-models', App\Livewire\Master\DeviceModelManager::class)->name('device-models');

    // Service Customers
    Route::get('/service-customers', App\Livewire\Master\ServiceCustomerManager::class)->name('service-customers');

    // Outside Service Centers
    Route::get('/outside-service-centers', App\Livewire\Master\OutsideServiceCenterManager::class)->name('outside-service-centers');

    // Store Dealers
    Route::get('/store-dealers', App\Livewire\Master\StoreDealerManager::class)->name('store-dealers');

    // Vendors
    Route::get('/vendors', App\Livewire\Master\VendorManager::class)->name('vendors');

    // Device Blacklists
    Route::get('/device-blacklists', App\Livewire\Master\DeviceBlacklistManager::class)->name('device-blacklists');

    // Store Taxes
    Route::get('/store-taxes', App\Livewire\Master\StoreTaxManager::class)->name('store-taxes');

    // Units
    Route::get('/units', App\Livewire\Master\UnitManager::class)->name('units');

    // Entry Via Options
    Route::get('/entry-via-options', App\Livewire\Master\EntryViaOptionManager::class)->name('entry-via-options');



    // Accounts
    Route::get('/chart-of-accounts', App\Livewire\ChartOfAccounts::class)->name('chart-of-accounts');

    Route::get('/ledgers', App\Livewire\Ledgers::class)->name('ledgers');

    Route::get('/receipt-entry', App\Livewire\ReceiptEntry::class)->name('receipt-entry');

    Route::get('/payment-entry', App\Livewire\PaymentEntry::class)->name('payment-entry');

    Route::get('/journal-entries', App\Livewire\JournalEntries::class)->name('journal-entries');

    Route::get('/trial-balance', App\Livewire\TrialBalance::class)->name('trial-balance');

    Route::get('/balance-sheet', App\Livewire\BalanceSheet::class)->name('balance-sheet');

    Route::get('/profit-loss', App\Livewire\ProfitLoss::class)->name('profit-loss');

    Route::get('/user-privileges', App\Livewire\UserPrivileges::class)->name('user-privileges');

    Route::get('/services/job-entry', App\Livewire\ServicesJobEntry::class)->name('services.job-entry');

    Route::get('/user-management',  App\Livewire\UserManagement::class)->name('user-management');

    Route::get('/attencdence',  App\Livewire\Attendence::class)->name('attencdence');

    Route::get('/salary-payment',  App\Livewire\SalaryPayments::class)->name('salary-payment');

    Route::get('/store-items',  App\Livewire\StoreItemManager::class)->name('store-items');

    Route::get('/purchase/create',  App\Livewire\PurchaseForm::class)->name('purchase.create');


    Route::fallback(function () {
        return response()->view('errors.subdomain_not_found', [], 404);
    });
//});
