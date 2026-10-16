 <?php



use Illuminate\Database\Migrations\Migration;

use Illuminate\Database\Schema\Blueprint;

use Illuminate\Support\Facades\Schema;



return new class extends Migration

{

    public function up(): void

    {

        Schema::create('harley_listings', function (Blueprint $table) {

            $table->id(); // 1



            // 1. ข้อมูลลงประกาศและผู้ขาย

            $table->string('title', 255)->comment('หัวข้อลงประกาศ'); // 2

            $table->foreignId('user_id')->constrained()->onDelete('cascade')->comment('ผู้ลงขาย'); // 3

            $table->string('seller_name', 100)->comment('ชื่อผู้ติดต่อ'); // 4

            $table->string('seller_phone', 50)->comment('เบอร์โทรศัพท์'); // 5

            $table->string('seller_line_id', 50)->nullable()->comment('Line ID'); // 6

            $table->enum('seller_type', ['private', 'dealer'])->default('private')->comment('ประเภทผู้ขาย'); // 7



            // 2. ข้อมูลพื้นฐานของตัวรถ

            $table->string('vin', 17)->unique()->comment('เลขตัวถัง VIN'); // 8

            $table->string('engine_number', 50)->nullable()->comment('เลขเครื่องยนต์'); // 9

            $table->string('license_plate', 20)->comment('ทะเบียนรถ'); // 10

            $table->string('registration_province', 100)->comment('จังหวัดที่จดทะเบียน'); // 11

            $table->string('family_series', 50)->comment('ตระกูลรถ (Softail, Touring, etc.)'); // 12

            $table->string('model_name', 100)->comment('ชื่อรุ่น (Fat Boy, Breakout, etc.)'); // 13

            $table->integer('model_year')->comment('ปีผลิต ค.ศ.'); // 14

            $table->integer('registration_year')->comment('ปีที่จดทะเบียน'); // 15

            $table->string('color_original', 50)->comment('สีเดิม'); // 16

            $table->string('color_current', 50)->nullable()->comment('สีปัจจุบัน'); // 17



            // 3. เครื่องยนต์และระบบขับเคลื่อน

            $table->string('engine_type', 100)->comment('ประเภทเครื่องยนต์'); // 18

            $table->integer('engine_capacity_cc')->comment('ขนาด CC'); // 19

            $table->string('transmission', 50)->comment('ระบบเกียร์'); // 20

            $table->string('fuel_system', 100)->default('ESPFI')->comment('ระบบจ่ายน้ำมัน'); // 21

            $table->string('exhaust_system', 100)->nullable()->comment('ท่อไอเสีย'); // 22

            $table->string('air_cleaner', 100)->nullable()->comment('กรองอากาศ'); // 23

            $table->string('ecu_tuning', 100)->nullable()->comment('กล่องจูน/ECU'); // 24



            // 4. สภาพรถ ไมล์ และของแต่ง

            $table->integer('mileage_km')->comment('ระยะทางไมล์'); // 25

            $table->enum('mileage_type', ['km', 'miles'])->default('km')->comment('หน่วยไมล์'); // 26

            $table->string('condition_rating', 50)->default('4_very_good')->comment('สภาพรถ'); // 27

            $table->boolean('has_abs')->default(true)->comment('มี ABS'); // 28

            $table->boolean('has_security_alarm')->default(true)->comment('มีสัญญาณกันขโมย'); // 29

            $table->boolean('has_keyless')->default(true)->comment('มี Keyless'); // 30

            $table->text('custom_accessories_detail')->nullable()->comment('รายละเอียดของแต่ง'); // 31

            $table->decimal('estimated_accessories_value', 12, 2)->default(0.00)->comment('มูลค่าของแต่ง'); // 32

            $table->boolean('has_original_parts')->default(true)->comment('มีของเดิมให้'); // 33



            // 5. ข้อมูลการเงินและการขาย

            $table->decimal('selling_price', 12, 2)->comment('ราคาขาย'); // 34

            $table->boolean('is_negotiable')->default(true)->comment('ต่อรองได้'); // 35

            $table->enum('finance_status', ['paid_off', 'on_finance'])->default('paid_off')->comment('สถานะไฟแนนซ์'); // 36

            $table->decimal('down_payment_price', 12, 2)->nullable()->comment('ราคาขายดาวน์'); // 37

            $table->decimal('monthly_installment', 12, 2)->nullable()->comment('ค่างวด/เดือน'); // 38

            $table->integer('remaining_months')->nullable()->comment('จำนวนงวดที่เหลือ'); // 39

            $table->string('finance_company_name', 100)->nullable()->comment('ไฟแนนซ์ของบริษัท'); // 40



            // 6. ประวัติการดูแล และประกันภัย

            $table->string('service_history', 100)->default('full_dealer_history')->comment('ประวัติเข้าศูนย์'); // 41

            $table->date('last_service_date')->nullable()->comment('วันเช็คระยะล่าสุด'); // 42

            $table->date('tax_expiry_date')->nullable()->comment('วันหมดภาษี/พ.ร.บ.'); // 43

            $table->string('insurance_type', 50)->nullable()->comment('ประเภทประกัน'); // 44

            $table->date('insurance_expiry_date')->nullable()->comment('วันหมดประกัน'); // 45



            // 7. ตำแหน่ง สถานะ และการบันทึก

            $table->string('viewing_location_province', 100)->comment('จังหวัดที่นัดดูรถ'); // 46

            $table->string('viewing_location_district', 100)->comment('อำเภอ/เขต นัดดูรถ'); // 47

            $table->enum('status', ['pending_review', 'active', 'sold', 'hidden'])->default('active')->comment('สถานะประกาศ'); // 48

            $table->boolean('is_featured')->default(false)->comment('ปักหมุดหน้าแรก'); // 49

            $table->unsignedBigInteger('views_count')->default(0)->comment('จำนวนคนดู'); // 50



            $table->timestamps();

        });

    }



    public function down(): void

    {

        Schema::dropIfExists('harley_listings');

    }

}; 