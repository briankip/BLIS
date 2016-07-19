<?php namespace Database\Seeds;

use Illuminate\Database\Seeder;
use App\Models\Configurable;
use App\Models\Field;
use App\Models\LabConfig;
use App\Models\ConField;
use App\Models\Analyser;

use DB;
use DateTime;
use DateInterval;
use App\Models\User;
use App\Models\Visit;
use App\Models\Charge;
use App\Models\Measure;
use App\Models\Payment;
use App\Models\Patient;
use App\Models\MeasureType;
use App\Models\MeasureRange;
use App\Models\ExternalDump;
use App\Models\RejectionReason;
use App\Models\Drug;
use App\Models\Role;
use App\Models\Organism;
use App\Models\Specimen;
use App\Models\SpecimenType;
use App\Models\Test;
use App\Models\TestType;
use App\Models\TestPhase;
use App\Models\TestStatus;
use App\Models\TestResult;
use App\Models\TestCategory;
use App\Models\SpecimenStatus;
use App\Models\TestTypeMeasure;
use App\Models\Metric;
use App\Models\Receipt;
use App\Models\Supplier;
use App\Models\Facility;
use App\Models\Commodity;
use App\Models\Permission;
use App\Models\Instrument;
use App\Models\Lot;
use App\Models\Issue;
use App\Models\Control;
use App\Models\Disease;
use App\Models\ControlTest;
use App\Models\TopupRequest;
use App\Models\ReportDisease;
use App\Models\ControlMeasure;
use App\Models\ControlMeasureRange;
use App\Models\ControlMeasureResult;


//	Carbon - for use with dates
use Jenssegers\Date\Date as Carbon;

class BlisDevelopmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::today()->toDateTimeString();
        /* Users table */
        $usersData = array(
            array(
                "username" => "lmorena", "password" => bcrypt("password"), "email" => "lmorena@kblis.org",
                "name" => "L. Morena", "designation" => "Lab Technologist", "image" => "/i/users/user-3.png"
            ),
            array(
                "username" => "abumeyang", "password" => bcrypt("password"), "email" => "abumeyang@kblis.org",
                "name" => "A. Abumeyang", "designation" => "Doctor"
            ),
        );

        foreach ($usersData as $user)
        {
            $users[] = User::create($user);
        }
        $this->command->info('More users seeded');


        /* Specimen Types table */
        $specTypesData = array(
            array("name" => "Ascitic Tap"),
            array("name" => "Aspirate"),
            array("name" => "CSF"),
            array("name" => "Dried Blood Spot"),
            array("name" => "High Vaginal Swab"),
            array("name" => "Nasal Swab"),
            array("name" => "Plasma"),
            array("name" => "Plasma EDTA"),
            array("name" => "Pleural Tap"),
            array("name" => "Pus Swab"),
            array("name" => "Rectal Swab"),
            array("name" => "Semen"),
            array("name" => "Serum"),
            array("name" => "Skin"),
            array("name" => "Sputum"),
            array("name" => "Stool"),
            array("name" => "Synovial Fluid"),
            array("name" => "Throat Swab"),
            array("name" => "Urethral Smear"),
            array("name" => "Urine"),
            array("name" => "Vaginal Smear"),
            array("name" => "Water"),
            array("name" => "Whole Blood"),
        );

        foreach ($specTypesData as $specimenType)
        {
            $specTypes[] = SpecimenType::create($specimenType);
        }
        $this->command->info('specimen_types seeded');
        
        /* Test Categories table - These map on to the lab sections */
        $test_categories = TestCategory::create(array("name" => "PARASITOLOGY","description" => "", "created_at" => $now, "updated_at" => $now));
        $lab_section_microbiology = TestCategory::create(array("name" => "MICROBIOLOGY","description" => "", "created_at" => $now, "updated_at" => $now));

        $this->command->info('Test categories seeded');

        /* Measures table */
        $measureBSforMPS = Measure::create(
            array("measure_type_id" => "2",
                "name" => "BS for mps", 
                "unit" => ""));
        $measure1 = Measure::create(array("measure_type_id" => "2", "name" => "Grams stain", "unit" => ""));
        $measure2 = Measure::create(array("measure_type_id" => "2", "name" => "SERUM AMYLASE", "unit" => ""));
        $measure3 = Measure::create(array("measure_type_id" => "2", "name" => "calcium", "unit" => ""));
        $measure4 = Measure::create(array("measure_type_id" => "2", "name" => "SGOT", "unit" => ""));
        $measure5 = Measure::create(array("measure_type_id" => "2", "name" => "Indirect COOMBS test", "unit" => ""));
        $measure6 = Measure::create(array("measure_type_id" => "2", "name" => "Direct COOMBS test", "unit" => ""));
        $measure7 = Measure::create(array("measure_type_id" => "2", "name" => "Du test", "unit" => ""));
        
        MeasureRange::create(array("measure_id" => $measureBSforMPS->id, "alphanumeric" => "No mps seen", "interpretation" => "Negative"));
        MeasureRange::create(array("measure_id" => $measureBSforMPS->id, "alphanumeric" => "+", "interpretation" => "Positive"));
        MeasureRange::create(array("measure_id" => $measureBSforMPS->id, "alphanumeric" => "++", "interpretation" => "Positive"));
        MeasureRange::create(array("measure_id" => $measureBSforMPS->id, "alphanumeric" => "+++", "interpretation" => "Positive"));
        
        MeasureRange::create(array("measure_id" => $measure1->id, "alphanumeric" => "Negative"));
        MeasureRange::create(array("measure_id" => $measure1->id, "alphanumeric" => "Positive"));

        MeasureRange::create(array("measure_id" => $measure2->id, "alphanumeric" => "Low"));
        MeasureRange::create(array("measure_id" => $measure2->id, "alphanumeric" => "High"));
        MeasureRange::create(array("measure_id" => $measure2->id, "alphanumeric" => "Normal"));

        MeasureRange::create(array("measure_id" => $measure3->id, "alphanumeric" => "High"));
        MeasureRange::create(array("measure_id" => $measure3->id, "alphanumeric" => "Low"));
        MeasureRange::create(array("measure_id" => $measure3->id, "alphanumeric" => "Normal"));

        MeasureRange::create(array("measure_id" => $measure4->id, "alphanumeric" => "High"));
        MeasureRange::create(array("measure_id" => $measure4->id, "alphanumeric" => "Low"));
        MeasureRange::create(array("measure_id" => $measure4->id, "alphanumeric" => "Normal"));
        
        MeasureRange::create(array("measure_id" => $measure5->id, "alphanumeric" => "Positive"));
        MeasureRange::create(array("measure_id" => $measure5->id, "alphanumeric" => "Negative"));

        MeasureRange::create(array("measure_id" => $measure6->id, "alphanumeric" => "Positive"));
        MeasureRange::create(array("measure_id" => $measure6->id, "alphanumeric" => "Negative"));

        MeasureRange::create(array("measure_id" => $measure7->id, "alphanumeric" => "Positive"));
        MeasureRange::create(array("measure_id" => $measure7->id, "alphanumeric" => "Negative"));
        $measures = array(
            array("measure_type_id" => "1", "name" => "URIC ACID", "unit" => "mg/dl"),
            array("measure_type_id" => "4", "name" => "CSF for biochemistry", "unit" => ""),
            array("measure_type_id" => "4", "name" => "PSA", "unit" => ""),
            array("measure_type_id" => "1", "name" => "Total", "unit" => "mg/dl"),
            array("measure_type_id" => "1", "name" => "Alkaline Phosphate", "unit" => "u/l"),
            array("measure_type_id" => "1", "name" => "Direct", "unit" => "mg/dl"),
            array("measure_type_id" => "1", "name" => "Total Proteins", "unit" => ""),
            array("measure_type_id" => "4", "name" => "LFTS", "unit" => "NULL"),
            array("measure_type_id" => "1", "name" => "Chloride", "unit" => "mmol/l"),
            array("measure_type_id" => "1", "name" => "Potassium", "unit" => "mmol/l"),
            array("measure_type_id" => "1", "name" => "Sodium", "unit" => "mmol/l"),
            array("measure_type_id" => "4", "name" => "Electrolytes", "unit" => ""),
            array("measure_type_id" => "1", "name" => "Creatinine", "unit" => "mg/dl"),
            array("measure_type_id" => "1", "name" => "Urea", "unit" => "mg/dl"),
            array("measure_type_id" => "4", "name" => "RFTS", "unit" => ""),
            array("measure_type_id" => "4", "name" => "TFT", "unit" => ""),
        );

        foreach ($measures as $measure)
        {
            Measure::create($measure);
        }
        $measureGXM = Measure::create(array("measure_type_id" => "4", "name" => "GXM", "unit" => ""));
        $measureBG = Measure::create(
            array("measure_type_id" => "2",
                "name" => "Blood Grouping", 
                "unit" => ""));
        MeasureRange::create(array("measure_id" => $measureBG->id, "alphanumeric" => "O-"));
        MeasureRange::create(array("measure_id" => $measureBG->id, "alphanumeric" => "O+"));
        MeasureRange::create(array("measure_id" => $measureBG->id, "alphanumeric" => "A-"));
        MeasureRange::create(array("measure_id" => $measureBG->id, "alphanumeric" => "A+"));
        MeasureRange::create(array("measure_id" => $measureBG->id, "alphanumeric" => "B-"));
        MeasureRange::create(array("measure_id" => $measureBG->id, "alphanumeric" => "B+"));
        MeasureRange::create(array("measure_id" => $measureBG->id, "alphanumeric" => "AB-"));
        MeasureRange::create(array("measure_id" => $measureBG->id, "alphanumeric" => "AB+"));        
        $measureHB = Measure::create(array("measure_type_id" => Measure::NUMERIC, "name" => "HB", 
            "unit" => "g/dL"));

        $measuresUrinalysisData = array(
            array("measure_type_id" => "4", "name" => "Urine microscopy", "unit" => ""),
            array("measure_type_id" => "4", "name" => "Pus cells", "unit" => ""),
            array("measure_type_id" => "4", "name" => "S. haematobium", "unit" => ""),
            array("measure_type_id" => "4", "name" => "T. vaginalis", "unit" => ""),
            array("measure_type_id" => "4", "name" => "Yeast cells", "unit" => ""),
            array("measure_type_id" => "4", "name" => "Red blood cells", "unit" => ""),
            array("measure_type_id" => "4", "name" => "Bacteria", "unit" => ""),
            array("measure_type_id" => "4", "name" => "Spermatozoa", "unit" => ""),
            array("measure_type_id" => "4", "name" => "Epithelial cells", "unit" => ""),
            array("measure_type_id" => "4", "name" => "ph", "unit" => ""),
            array("measure_type_id" => "4", "name" => "Urine chemistry", "unit" => ""),
            array("measure_type_id" => "4", "name" => "Glucose", "unit" => ""),
            array("measure_type_id" => "4", "name" => "Ketones", "unit" => ""),
            array("measure_type_id" => "4", "name" => "Proteins", "unit" => ""),
            array("measure_type_id" => "4", "name" => "Blood", "unit" => ""),
            array("measure_type_id" => "4", "name" => "Bilirubin", "unit" => ""),
            array("measure_type_id" => "4", "name" => "Urobilinogen Phenlpyruvic acid", "unit" => ""),
            array("measure_type_id" => "4", "name" => "pH", "unit" => "")
            );

        foreach ($measuresUrinalysisData as $measureU) {
            $measuresUrinalysis[] = Measure::create($measureU);
        }

        $measuresWBCData = array(
            array("measure_type_id" => Measure::NUMERIC, "name" => "WBC", 
                "unit" => "x10³/µL"),
            array("measure_type_id" => Measure::NUMERIC, "name" => "Lym", "unit" => "L"),
            array("measure_type_id" => Measure::NUMERIC, "name" => "Mon", "unit" => "*"),
            array("measure_type_id" => Measure::NUMERIC, "name" => "Neu", "unit" => "*"),
            array("measure_type_id" => Measure::NUMERIC, "name" => "Eos", "unit" => ""),
            array("measure_type_id" => Measure::NUMERIC, "name" => "Baso", "unit" => ""),
            );

        foreach ($measuresWBCData as $value) {
            $measuresWBC[] = Measure::create($value);
        }

        $measureRangesWBC = array(
            array("measure_id" => $measuresWBC[0]->id, "age_min" => 0, "age_max" => 100, "gender" => MeasureRange::BOTH,
                "range_lower" => 4, "range_upper" => 11),
            array("measure_id" => $measuresWBC[1]->id, "age_min" => 0, "age_max" => 100, "gender" => MeasureRange::BOTH,
                "range_lower" => 1.5, "range_upper" => 4),
            array("measure_id" => $measuresWBC[2]->id, "age_min" => 0, "age_max" => 100, "gender" => MeasureRange::BOTH,
                "range_lower" => 0.1, "range_upper" => 9),
            array("measure_id" => $measuresWBC[3]->id, "age_min" => 0, "age_max" => 100, "gender" => MeasureRange::BOTH,
                "range_lower" => 2.5, "range_upper" => 7),
            array("measure_id" => $measuresWBC[4]->id, "age_min" => 0, "age_max" => 100, "gender" => MeasureRange::BOTH,
                "range_lower" => 0, "range_upper" => 6),
            array("measure_id" => $measuresWBC[5]->id, "age_min" => 0, "age_max" => 100, "gender" => MeasureRange::BOTH,
                "range_lower" => 0, "range_upper" => 2),
            );

        foreach ($measureRangesWBC as $value) {
            MeasureRange::create($value);
        }

        $this->command->info('measures seeded');
        
        /* Test Types table */
        $testTypeBS = TestType::create(array("name" => "BS for mps", "test_category_id" => $test_categories->id));
        $testTypeStoolCS = TestType::create(array("name" => "Stool for C/S", "test_category_id" => $lab_section_microbiology->id));
        $testTypeGXM = TestType::create(array("name" => "GXM", "test_category_id" => $test_categories->id));
        $testTypeHB = TestType::create(array("name" => "HB", "test_category_id" => $test_categories->id));
        $testTypeUrinalysis = TestType::create(array("name" => "Urinalysis", "test_category_id" => $test_categories->id));
        $testTypeWBC = TestType::create(array("name" => "WBC", "test_category_id" => $test_categories->id));

        $this->command->info('test_types seeded');

        /* TestType Measure table */
        TestTypeMeasure::create(array("test_type_id" => $testTypeBS->id, "measure_id" => $measureBSforMPS->id));
        TestTypeMeasure::create(array("test_type_id" => $testTypeGXM->id, "measure_id" => $measureGXM->id));
        TestTypeMeasure::create(array("test_type_id" => $testTypeGXM->id, "measure_id" => $measureBG->id));
        TestTypeMeasure::create(array("test_type_id" => $testTypeHB->id, "measure_id" => $measureHB->id));

        foreach ($measuresUrinalysis as $value) {
            TestTypeMeasure::create(array("test_type_id" => $testTypeUrinalysis->id, "measure_id" => $value->id));
        }

        foreach ($measuresWBC as $value) {
            TestTypeMeasure::create(array("test_type_id" => $testTypeWBC->id, "measure_id" => $value->id));
        }

        $this->command->info('testtype_measures seeded');

        /* testtype_specimentypes table */
        DB::table('testtype_specimentypes')->insert(
            array("test_type_id" => $testTypeBS->id, "specimen_type_id" => $specTypes[count($specTypes)-1]->id));
        DB::table('testtype_specimentypes')->insert(
            array("test_type_id" => $testTypeGXM->id, "specimen_type_id" => $specTypes[count($specTypes)-1]->id));
        DB::table('testtype_specimentypes')->insert(
            array("test_type_id" => $testTypeHB->id, "specimen_type_id" => $specTypes[count($specTypes)-1]->id));
        DB::table('testtype_specimentypes')->insert(
            array("test_type_id" => $testTypeHB->id, "specimen_type_id" => $specTypes[6]->id));
        DB::table('testtype_specimentypes')->insert(
            array("test_type_id" => $testTypeHB->id, "specimen_type_id" => $specTypes[7]->id));
        DB::table('testtype_specimentypes')->insert(
            array("test_type_id" => $testTypeHB->id, "specimen_type_id" => $specTypes[12]->id));
        DB::table('testtype_specimentypes')->insert(
            array("test_type_id" => $testTypeUrinalysis->id, "specimen_type_id" => $specTypes[19]->id));
        DB::table('testtype_specimentypes')->insert(
            array("test_type_id" => $testTypeUrinalysis->id, "specimen_type_id" => $specTypes[20]->id));
        DB::table('testtype_specimentypes')->insert(
            array("test_type_id" => $testTypeWBC->id, "specimen_type_id" => $specTypes[count($specTypes)-1]->id));

        $this->command->info('testtype_specimentypes seeded');

        /* Patients table */
        $patients_array = array(
            array("name" => "Jam Felicia", "email" => "fj@x.com", "patient_number" => "1002", "dob" => "2000-01-01", "gender" => "1", "created_by" => "2"),
            array("name" => "Emma Wallace", "email" => "emma@snd.com", "patient_number" => "1003", "dob" => "1990-03-01", "gender" => "1", "created_by" => "2"),
            array("name" => "Jack Tee", "email" => "info@jt.co.ke", "patient_number" => "1004", "dob" => "1999-12-18", "gender" => "0", "created_by" => "1"),
            array("name" => "Hu Jintao", "email" => "hu@.un.org", "patient_number" => "1005", "dob" => "1956-10-28", "gender" => "0", "created_by" => "2"),
            array("name" => "Lance Opiyo", "email" => "lance@x.com", "patient_number" => "2150", "dob" => "2012-01-01", "gender" => "0", "created_by" => "1"));
        foreach ($patients_array as $pat) {
            $patients[] = Patient::create($pat);
        }

        $this->command->info('patients seeded');

        /* Visits table */
        
        for ($i=0; $i < 7; $i++) { 
            $visits[] = Visit::create(array("patient_id" => $patients[rand(0,count($patients)-1)]->id));
        }
        $this->command->info('visits seeded');

        /* Rejection Reasons table */
        $rejection_reasons_array = array(
          array("reason" => "Poorly labelled"),
          array("reason" => "Over saturation"),
          array("reason" => "Insufficient Sample"),
          array("reason" => "Scattered"),
          array("reason" => "Clotted Blood"),
          array("reason" => "Two layered spots"),
          array("reason" => "Serum rings"),
          array("reason" => "Scratched"),
          array("reason" => "Haemolysis"),
          array("reason" => "Spots that cannot elute"),
          array("reason" => "Leaking"),
          array("reason" => "Broken Sample Container"),
          array("reason" => "Mismatched sample and form labelling"),
          array("reason" => "Missing Labels on container and tracking form"),
          array("reason" => "Empty Container"),
          array("reason" => "Samples without tracking forms"),
          array("reason" => "Poor transport"),
          array("reason" => "Lipaemic"),
          array("reason" => "Wrong container/Anticoagulant"),
          array("reason" => "Request form without samples"),
          array("reason" => "Missing collection date on specimen / request form."),
          array("reason" => "Name and signature of requester missing"),
          array("reason" => "Mismatched information on request form and specimen container."),
          array("reason" => "Request form contaminated with specimen"),
          array("reason" => "Duplicate specimen received"),
          array("reason" => "Delay between specimen collection and arrival in the laboratory"),
          array("reason" => "Inappropriate specimen packing"),
          array("reason" => "Inappropriate specimen for the test"),
          array("reason" => "Inappropriate test for the clinical condition"),
          array("reason" => "No Label"),
          array("reason" => "Leaking"),
          array("reason" => "No Sample in the Container"),
          array("reason" => "No Request Form"),
          array("reason" => "Missing Information Required"),
        );
        foreach ($rejection_reasons_array as $rejection_reason)
        {
            $rejection_reasons[] = RejectionReason::create($rejection_reason);
        }
        $this->command->info('rejection_reasons seeded');

        /* Specimen table */
       
        $this->command->info('specimens seeded');
        $now = new DateTime();

        /* Test table */
        Test::create(
            array(
                "visit_id" => $visits[rand(0,count($visits)-1)]->id,
                "test_type_id" => $testTypeBS->id,//BS for MPS
                "specimen_id" => $this->createSpecimen(
                        Test::NOT_RECEIVED, Specimen::NOT_COLLECTED,
                        SpecimenType::all()->last()->id,
                        $users[rand(0, count($users)-1)]->id),
                "test_status_id" => Test::NOT_RECEIVED,
                "requested_by" => "Dr. Abou Meyang",
                "created_by" => $users[rand(0, count($users)-1)]->id,
            )
        );        
        
        Test::create(
            array(
                "visit_id" => $visits[rand(0,count($visits)-1)]->id,
                "test_type_id" => $testTypeHB->id,
                "specimen_id" => $this->createSpecimen(
                        Test::PENDING, Specimen::NOT_COLLECTED,
                        SpecimenType::all()->last()->id,
                        $users[rand(0, count($users)-1)]->id),
                "test_status_id" => Test::PENDING,
                "requested_by" => "Dr. Abou Meyang",
                "created_by" => $users[rand(0, count($users)-1)]->id,
            )
        );        
        
        Test::create(
            array(
                "visit_id" => $visits[rand(0,count($visits)-1)]->id,
                "test_type_id" => $testTypeGXM->id,
                "specimen_id" => $this->createSpecimen(
                        Test::PENDING, Specimen::NOT_COLLECTED,
                        SpecimenType::all()->last()->id,
                        $users[rand(0, count($users)-1)]->id),
                "test_status_id" => Test::PENDING,
                "requested_by" => "Dr. Abou Meyang",
                "created_by" => $users[rand(0, count($users)-1)]->id,
            )
        );        
        
        Test::create(
            array(
                "visit_id" => $visits[rand(0,count($visits)-1)]->id,
                "test_type_id" => $testTypeBS->id,//BS for MPS
                "specimen_id" => $this->createSpecimen(
                        Test::PENDING, Specimen::ACCEPTED,
                        SpecimenType::all()->last()->id,
                        $users[rand(0, count($users)-1)]->id),
                "test_status_id" => Test::PENDING,
                "created_by" => $users[rand(0, count($users)-1)]->id,
                "requested_by" => "Dr. Abou Meyang",
            )
        );        
        
        $test_gxm_accepted_completed = Test::create(
            array(
                "visit_id" => $visits[rand(0,count($visits)-1)]->id,
                "test_type_id" => $testTypeGXM->id,
                "specimen_id" => $this->createSpecimen(
                        Test::COMPLETED, Specimen::ACCEPTED, 
                        SpecimenType::all()->last()->id, 
                        $users[rand(0, count($users)-1)]->id),
                "interpretation" => "Perfect match.",
                "test_status_id" => Test::COMPLETED,
                "created_by" => $users[rand(0, count($users)-1)]->id,
                "tested_by" => $users[rand(0, count($users)-1)]->id,
                "requested_by" => "Dr. Abou Meyang",
                "time_started" => $now->format('Y-m-d H:i:s'),
                "time_completed" => $now->add(new DateInterval('PT12M8S'))->format('Y-m-d H:i:s'),
            )
        );

        $test_hb_accepted_completed = Test::create(
            array(
                "visit_id" => $visits[rand(0,count($visits)-1)]->id,
                "test_type_id" => $testTypeHB->id,
                "specimen_id" => $this->createSpecimen(
                        Test::COMPLETED, Specimen::ACCEPTED, 
                        SpecimenType::all()->last()->id, 
                        $users[rand(0, count($users)-1)]->id),
                "interpretation" => "Do nothing!",
                "test_status_id" => Test::COMPLETED,
                "created_by" => $users[rand(0, count($users)-1)]->id,
                "tested_by" => $users[rand(0, count($users)-1)]->id,
                "requested_by" => "Genghiz Khan",
                "time_started" => $now->format('Y-m-d H:i:s'),
                "time_completed" => $now->add(new DateInterval('PT5M23S'))->format('Y-m-d H:i:s'),
            )
        );

        $tests_accepted_started = Test::create(
            array(
                "visit_id" => $visits[rand(0,count($visits)-1)]->id,
                "test_type_id" => $testTypeGXM->id,
                "specimen_id" => $this->createSpecimen(
                    Test::STARTED, Specimen::ACCEPTED, SpecimenType::all()->last()->id, 
                    $users[rand(0, count($users)-1)]->id),
                "test_status_id" => Test::STARTED,
                "requested_by" => "Dr. Abou Meyang",
                "created_by" => $users[rand(0, count($users)-1)]->id,
                "time_started" => $now->format('Y-m-d H:i:s'),
            )
        );

        $tests_accepted_completed = Test::create(
            array(
                "visit_id" => $visits[rand(0,count($visits)-1)]->id,
                "test_type_id" => $testTypeBS->id,//BS for MPS
                "specimen_id" => $this->createSpecimen(
                        Test::COMPLETED, Specimen::ACCEPTED, 
                        SpecimenType::all()->last()->id, 
                        $users[rand(0, count($users)-1)]->id),
                "interpretation" => "Positive",
                "test_status_id" => Test::COMPLETED,
                "created_by" => $users[rand(0, count($users)-1)]->id,
                "tested_by" => $users[rand(0, count($users)-1)]->id,
                "requested_by" => "Ariel Smith",
                "time_started" => $now->format('Y-m-d H:i:s'),
                "time_completed" => $now->add(new DateInterval('PT7M34S'))->format('Y-m-d H:i:s'),
            )
        );        
        
        $tests_accepted_verified = Test::create(
            array(
                "visit_id" => $visits[rand(0,count($visits)-1)]->id,
                "test_type_id" => $testTypeBS->id,//BS for MPS
                "specimen_id" => $this->createSpecimen(
                        Test::VERIFIED, Specimen::ACCEPTED, 
                        SpecimenType::all()->last()->id, 
                        $users[rand(0, count($users)-1)]->id),
                "interpretation" => "Very high concentration of parasites.",
                "test_status_id" => Test::VERIFIED,
                "created_by" => $users[rand(0, count($users)-1)]->id,
                "tested_by" => $users[rand(0, count($users)-1)]->id,
                "verified_by" => $users[rand(0, count($users)-1)]->id,
                "requested_by" => "Genghiz Khan",
                "time_started" => $now,
                "time_completed" => $now->add(new DateInterval('PT5M17S'))->format('Y-m-d H:i:s'),
                "time_verified" => $now->add(new DateInterval('PT112M33S'))->format('Y-m-d H:i:s'),
            )
        );        
        
        $tests_rejected_pending = Test::create(
            array(
                "visit_id" => $visits[rand(0,count($visits)-1)]->id,
                "test_type_id" => $testTypeBS->id,//BS for MPS
                "specimen_id" => $this->createSpecimen(
                        Test::PENDING, Specimen::REJECTED, 
                        SpecimenType::all()->last()->id, 
                        $users[rand(0, count($users)-1)]->id,
                        $users[rand(0, count($users)-1)]->id,
                        $rejection_reasons[rand(0,count($rejection_reasons)-1)]->id),
                "test_status_id" => Test::PENDING,
                "requested_by" => "Dr. Abou Meyang",
                "created_by" => $users[rand(0, count($users)-1)]->id,
                "time_started" => $now->format('Y-m-d H:i:s'),
            )
        );        

        //  WBC Started
        Test::create(
            array(
                "visit_id" => $visits[rand(0,count($visits)-1)]->id,
                "test_type_id" => $testTypeWBC->id,
                "specimen_id" => $this->createSpecimen(
                        Test::STARTED, Specimen::ACCEPTED,
                        SpecimenType::all()->last()->id,
                        $users[rand(0, count($users)-1)]->id),
                "test_status_id" => Test::PENDING,
                "requested_by" => "Fred Astaire",
                "created_by" => $users[rand(0, count($users)-1)]->id,
            )
        );        
        
        $tests_rejected_started = Test::create(
            array(
                "visit_id" => $visits[rand(0,count($visits)-1)]->id,
                "test_type_id" => $testTypeBS->id,//BS for MPS
                "specimen_id" => $this->createSpecimen(
                        Test::STARTED, Specimen::REJECTED, 
                        SpecimenType::all()->last()->id, 
                        $users[rand(0, count($users)-1)]->id,
                        $users[rand(0, count($users)-1)]->id,
                        $rejection_reasons[rand(0,count($rejection_reasons)-1)]->id),
                "test_status_id" => Test::STARTED,
                "created_by" => $users[rand(0, count($users)-1)]->id,
                "requested_by" => "Bony Em",
                "time_started" => $now->format('Y-m-d H:i:s'),
            )
        );
        
        $tests_rejected_completed = Test::create(
            array(
                "visit_id" => $visits[rand(0,count($visits)-1)]->id,
                "test_type_id" => $testTypeBS->id,//BS for MPS
                "specimen_id" => $this->createSpecimen(
                        Test::COMPLETED, Specimen::REJECTED, 
                        SpecimenType::all()->last()->id, 
                        $users[rand(0, count($users)-1)]->id,
                        $users[rand(0, count($users)-1)]->id,
                        $rejection_reasons[rand(0,count($rejection_reasons)-1)]->id),
                "interpretation" => "Budda Boss",
                "test_status_id" => Test::COMPLETED,
                "created_by" => $users[rand(0, count($users)-1)]->id,
                "tested_by" => $users[rand(0, count($users)-1)]->id,
                "requested_by" => "Ed Buttler",
                "time_started" => $now->format('Y-m-d H:i:s'),
                "time_completed" => $now->add(new DateInterval('PT30M4S'))->format('Y-m-d H:i:s'),
            )
        );

        Test::create(
            array(
                "visit_id" => $visits[rand(0,count($visits)-1)]->id,
                "test_type_id" => $testTypeUrinalysis->id,
                "specimen_id" => $this->createSpecimen(
                        Test::PENDING, Specimen::NOT_COLLECTED,
                        SpecimenType::all()->last()->id,
                        $users[rand(0, count($users)-1)]->id),
                "test_status_id" => Test::PENDING,
                "requested_by" => "Dr. Abou Meyang",
                "created_by" => $users[rand(0, count($users)-1)]->id,
            )
        );        
        
        Test::create(
            array(
                "visit_id" => $visits[rand(0,count($visits)-1)]->id,
                "test_type_id" => $testTypeWBC->id,
                "specimen_id" => $this->createSpecimen(
                        Test::PENDING, Specimen::NOT_COLLECTED,
                        SpecimenType::all()->last()->id,
                        $users[rand(0, count($users)-1)]->id),
                "test_status_id" => Test::PENDING,
                "requested_by" => "Dr. Abou Meyang",
                "created_by" => $users[rand(0, count($users)-1)]->id,
            )
        );        
        
        $test_urinalysis_accepted_completed = Test::create(
            array(
                "visit_id" => $visits[rand(0,count($visits)-1)]->id,
                "test_type_id" => $testTypeUrinalysis->id,
                "specimen_id" => $this->createSpecimen(
                        Test::COMPLETED, Specimen::ACCEPTED, 
                        SpecimenType::all()->last()->id, 
                        $users[rand(0, count($users)-1)]->id),
                "interpretation" => "Whats this !!!! ###%%% ^ *() /",
                "test_status_id" => Test::COMPLETED,
                "created_by" => $users[rand(0, count($users)-1)]->id,
                "tested_by" => $users[rand(0, count($users)-1)]->id,
                "requested_by" => "Dr. Abou Meyang",
                "time_started" => $now->format('Y-m-d H:i:s'),
                "time_completed" => $now->add(new DateInterval('PT12M8S'))->format('Y-m-d H:i:s'),
                "external_id" => 596699,
            )
        );

        $this->command->info('tests seeded');

        /* Test Results table */
        $testResults = array(
            array(
                "test_id" => $tests_accepted_verified->id,
                "measure_id" => $measureBSforMPS->id,//BS for MPS
                "result" => "+++",
            ),
            array(
                "test_id" => $tests_accepted_completed->id,
                "measure_id" => $measureBSforMPS->id,//BS for MPS
                "result" => "++",
            ),
            array(
                "test_id" => $test_gxm_accepted_completed->id,
                "measure_id" => $measureGXM->id,
                "result" => "COMPATIBLE WITH 061832914 B/G A POS.EXPIRY19/8/14",
            ),
            array(
                "test_id" => $test_gxm_accepted_completed->id,
                "measure_id" => $measureBG->id,
                "result" => "A+",
            ),
            array(
                "test_id" => $test_hb_accepted_completed->id,
                "measure_id" => $measureHB->id,
                "result" => "13.7",
            ),
            array(
                "test_id" => $tests_rejected_completed->id,
                "measure_id" => $measureBSforMPS->id,//BS for MPS
                "result" => "No mps seen",
            ));

        foreach ($measuresUrinalysis as $key => $measure) {
            $testResults[] = array(
                "test_id" => $test_urinalysis_accepted_completed->id,
                "measure_id" => $measure->id,
                "result" => $key."50",
            );
        }

        foreach ($testResults as $testResult)
        {
            TestResult::create($testResult);
        }
        $this->command->info('test results seeded');

        /* Instruments table */
        $instrumentsData = array(
            "name" => "Celltac F Mek 8222",
            "description" => "Automatic analyzer with 22 parameters and WBC 5 part diff Hematology Analyzer",
            "driver_name" => "KBLIS\\Plugins\\CelltacFMachine",
            "ip" => "192.168.1.12",
            "hostname" => "HEMASERVER"
        );
        
        $instrument = Instrument::create($instrumentsData);
        $instrument->testTypes()->attach(array($testTypeWBC->id));

        $this->command->info('Instruments table seeded');


        $labRequestUrinalysis[] = 
            json_decode('{"cost":null,"receiptNumber":null,"receiptType":null,"labNo":596699,"parentLabNo":0,"requestingClinician":"frankenstein Dr",
        "investigation":"Urinalysis","requestDate":"2014-10-14 10:20:35","orderStage":"ip","patientVisitNumber":643660,"patient":{"id":326983,
        "fullName":"Macau Macau","dateOfBirth":"1996-10-09 00:00:00","gender":"Female"},"address":{"address":null,"postalCode":null,"phoneNumber":"","city":null}}');
        $labRequestUrinalysis[] = 
            json_decode('{"cost":null,"receiptNumber":null,"receiptType":null,"labNo":596700,"parentLabNo":596699,"requestingClinician":"frankenstein Dr",
        "investigation":"Urine microscopy","requestDate":"2014-10-14 10:20:35","orderStage":"ip","patientVisitNumber":643660,"patient":{"id":326983,
        "fullName":"Macau Macau","dateOfBirth":"1996-10-09 00:00:00","gender":"Female"},"address":{"address":null,"postalCode":null,"phoneNumber":"","city":null}}');
        $labRequestUrinalysis[] = 
            json_decode('{"cost":null,"receiptNumber":null,"receiptType":null,"labNo":596701,"parentLabNo":596700,"requestingClinician":"frankenstein Dr",
        "investigation":"Pus cells","requestDate":"2014-10-14 10:20:35","orderStage":"ip","patientVisitNumber":643660,"patient":{"id":326983,
        "fullName":"Macau Macau","dateOfBirth":"1996-10-09 00:00:00","gender":"Female"},"address":{"address":null,"postalCode":null,"phoneNumber":"","city":null}}');
        $labRequestUrinalysis[] = 
            json_decode('{"cost":null,"receiptNumber":null,"receiptType":null,"labNo":596702,"parentLabNo":596700,"requestingClinician":"frankenstein Dr",
        "investigation":"S. haematobium","requestDate":"2014-10-14 10:20:35","orderStage":"ip","patientVisitNumber":643660,"patient":{"id":326983,
        "fullName":"Macau Macau","dateOfBirth":"1996-10-09 00:00:00","gender":"Female"},"address":{"address":null,"postalCode":null,"phoneNumber":"","city":null}}');
        $labRequestUrinalysis[] = 
            json_decode('{"cost":null,"receiptNumber":null,"receiptType":null,"labNo":596703,"parentLabNo":596700,"requestingClinician":"frankenstein Dr",
        "investigation":"T. vaginalis","requestDate":"2014-10-14 10:20:35","orderStage":"ip","patientVisitNumber":643660,"patient":{"id":326983,
        "fullName":"Macau Macau","dateOfBirth":"1996-10-09 00:00:00","gender":"Female"},"address":{"address":null,"postalCode":null,"phoneNumber":"","city":null}}');
        $labRequestUrinalysis[] = 
            json_decode('{"cost":null,"receiptNumber":null,"receiptType":null,"labNo":596704,"parentLabNo":596700,"requestingClinician":"frankenstein Dr",
        "investigation":"Yeast cells","requestDate":"2014-10-14 10:20:35","orderStage":"ip","patientVisitNumber":643660,"patient":{"id":326983,
        "fullName":"Macau Macau","dateOfBirth":"1996-10-09 00:00:00","gender":"Female"},"address":{"address":null,"postalCode":null,"phoneNumber":"","city":null}}');
        $labRequestUrinalysis[] = 
            json_decode('{"cost":null,"receiptNumber":null,"receiptType":null,"labNo":596705,"parentLabNo":596700,"requestingClinician":"frankenstein Dr",
        "investigation":"Red blood cells","requestDate":"2014-10-14 10:20:35","orderStage":"ip","patientVisitNumber":643660,"patient":{"id":326983,
        "fullName":"Macau Macau","dateOfBirth":"1996-10-09 00:00:00","gender":"Female"},"address":{"address":null,"postalCode":null,"phoneNumber":"","city":null}}');
        $labRequestUrinalysis[] = 
            json_decode('{"cost":null,"receiptNumber":null,"receiptType":null,"labNo":596706,"parentLabNo":596700,"requestingClinician":"frankenstein Dr",
        "investigation":"Bacteria","requestDate":"2014-10-14 10:20:36","orderStage":"ip","patientVisitNumber":643660,"patient":{"id":326983,
        "fullName":"Macau Macau","dateOfBirth":"1996-10-09 00:00:00","gender":"Female"},"address":{"address":null,"postalCode":null,"phoneNumber":"","city":null}}');
        $labRequestUrinalysis[] = 
            json_decode('{"cost":null,"receiptNumber":null,"receiptType":null,"labNo":596707,"parentLabNo":596700,"requestingClinician":"frankenstein Dr",
        "investigation":"Spermatozoa","requestDate":"2014-10-14 10:20:36","orderStage":"ip","patientVisitNumber":643660,"patient":{"id":326983,
        "fullName":"Macau Macau","dateOfBirth":"1996-10-09 00:00:00","gender":"Female"},"address":{"address":null,"postalCode":null,"phoneNumber":"","city":null}}');
        $labRequestUrinalysis[] = 
            json_decode('{"cost":null,"receiptNumber":null,"receiptType":null,"labNo":596708,"parentLabNo":596700,"requestingClinician":"frankenstein Dr",
        "investigation":"Epithelial cells","requestDate":"2014-10-14 10:20:36","orderStage":"ip","patientVisitNumber":643660,"patient":{"id":326983,
        "fullName":"Macau Macau","dateOfBirth":"1996-10-09 00:00:00","gender":"Female"},"address":{"address":null,"postalCode":null,"phoneNumber":"","city":null}}');
        $labRequestUrinalysis[] = 
            json_decode('{"cost":null,"receiptNumber":null,"receiptType":null,"labNo":596709,"parentLabNo":596700,"requestingClinician":"frankenstein Dr",
        "investigation":"ph","requestDate":"2014-10-14 10:20:36","orderStage":"ip","patientVisitNumber":643660,"patient":{"id":326983,
        "fullName":"Macau Macau","dateOfBirth":"1996-10-09 00:00:00","gender":"Female"},"address":{"address":null,"postalCode":null,"phoneNumber":"","city":null}}');
        $labRequestUrinalysis[] = 
            json_decode('{"cost":null,"receiptNumber":null,"receiptType":null,"labNo":596710,"parentLabNo":596699,"requestingClinician":"frankenstein Dr",
        "investigation":"Urine chemistry","requestDate":"2014-10-14 10:20:36","orderStage":"ip","patientVisitNumber":643660,"patient":{"id":326983,
        "fullName":"Macau Macau","dateOfBirth":"1996-10-09 00:00:00","gender":"Female"},"address":{"address":null,"postalCode":null,"phoneNumber":"","city":null}}');
        $labRequestUrinalysis[] = 
            json_decode('{"cost":null,"receiptNumber":null,"receiptType":null,"labNo":596711,"parentLabNo":596710,"requestingClinician":"frankenstein Dr",
        "investigation":"Glucose","requestDate":"2014-10-14 10:20:36","orderStage":"ip","patientVisitNumber":643660,"patient":{"id":326983,
        "fullName":"Macau Macau","dateOfBirth":"1996-10-09 00:00:00","gender":"Female"},"address":{"address":null,"postalCode":null,"phoneNumber":"","city":null}}');
        $labRequestUrinalysis[] = 
            json_decode('{"cost":null,"receiptNumber":null,"receiptType":null,"labNo":596712,"parentLabNo":596710,"requestingClinician":"frankenstein Dr",
        "investigation":"Ketones","requestDate":"2014-10-14 10:20:36","orderStage":"ip","patientVisitNumber":643660,"patient":{"id":326983,
        "fullName":"Macau Macau","dateOfBirth":"1996-10-09 00:00:00","gender":"Female"},"address":{"address":null,"postalCode":null,"phoneNumber":"","city":null}}');
        $labRequestUrinalysis[] = 
            json_decode('{"cost":null,"receiptNumber":null,"receiptType":null,"labNo":596713,"parentLabNo":596710,"requestingClinician":"frankenstein Dr",
        "investigation":"Proteins","requestDate":"2014-10-14 10:20:36","orderStage":"ip","patientVisitNumber":643660,"patient":{"id":326983,
        "fullName":"Macau Macau","dateOfBirth":"1996-10-09 00:00:00","gender":"Female"},"address":{"address":null,"postalCode":null,"phoneNumber":"","city":null}}');
        $labRequestUrinalysis[] = 
            json_decode('{"cost":null,"receiptNumber":null,"receiptType":null,"labNo":596714,"parentLabNo":596710,"requestingClinician":"frankenstein Dr",
        "investigation":"Blood","requestDate":"2014-10-14 10:20:36","orderStage":"ip","patientVisitNumber":643660,"patient":{"id":326983,
        "fullName":"Macau Macau","dateOfBirth":"1996-10-09 00:00:00","gender":"Female"},"address":{"address":null,"postalCode":null,"phoneNumber":"","city":null}}');
        $labRequestUrinalysis[] = 
            json_decode('{"cost":null,"receiptNumber":null,"receiptType":null,"labNo":596715,"parentLabNo":596710,"requestingClinician":"frankenstein Dr",
        "investigation":"Bilirubin","requestDate":"2014-10-14 10:20:36","orderStage":"ip","patientVisitNumber":643660,"patient":{"id":326983,
        "fullName":"Macau Macau","dateOfBirth":"1996-10-09 00:00:00","gender":"Female"},"address":{"address":null,"postalCode":null,"phoneNumber":"","city":null}}');
        $labRequestUrinalysis[] = 
            json_decode('{"cost":null,"receiptNumber":null,"receiptType":null,"labNo":596716,"parentLabNo":596710,"requestingClinician":"frankenstein Dr",
        "investigation":"Urobilinogen Phenlpyruvic acid","requestDate":"2014-10-14 10:20:37","orderStage":"ip","patientVisitNumber":643660,"patient":{"id":326983,
        "fullName":"Macau Macau","dateOfBirth":"1996-10-09 00:00:00","gender":"Female"},"address":{"address":null,"postalCode":null,"phoneNumber":"","city":null}}');
        $labRequestUrinalysis[] = 
            json_decode('{"cost":null,"receiptNumber":null,"receiptType":null,"labNo":596717,"parentLabNo":596710,"requestingClinician":"frankenstein Dr",
        "investigation":"pH","requestDate":"2014-10-14 10:20:37","orderStage":"ip","patientVisitNumber":643660,"patient":{"id":326983,
        "fullName":"Macau Macau","dateOfBirth":"1996-10-09 00:00:00","gender":"Female"},"address":{"address":null,"postalCode":null,"phoneNumber":"","city":null}}');

         for ($i=0; $i < count($labRequestUrinalysis); $i++) { 

            $dumper = new ExternalDump();
            $dumper->lab_no = $labRequestUrinalysis{$i}->labNo;
            $dumper->parent_lab_no = $labRequestUrinalysis{$i}->parentLabNo;
            $dumper->test_id = ($i == 0) ? $test_urinalysis_accepted_completed->id : null;
            $dumper->requesting_clinician = $labRequestUrinalysis{$i}->requestingClinician;
            $dumper->investigation = $labRequestUrinalysis{$i}->investigation;
            $dumper->provisional_diagnosis = '';
            $dumper->request_date = $labRequestUrinalysis{$i}->requestDate;
            $dumper->order_stage = $labRequestUrinalysis{$i}->orderStage;
            $dumper->patient_visit_number = $labRequestUrinalysis{$i}->patientVisitNumber;
            $dumper->patient_id = $labRequestUrinalysis{$i}->patient->id;
            $dumper->full_name = $labRequestUrinalysis{$i}->patient->fullName;
            $dumper->dob = $labRequestUrinalysis{$i}->patient->dateOfBirth;
            $dumper->gender = $labRequestUrinalysis{$i}->patient->gender;
            $dumper->address = $labRequestUrinalysis{$i}->address->address;
            $dumper->postal_code = '';
            $dumper->phone_number = $labRequestUrinalysis{$i}->address->phoneNumber;
            $dumper->city = $labRequestUrinalysis{$i}->address->city;
            $dumper->cost = $labRequestUrinalysis{$i}->cost;
            $dumper->receipt_number = $labRequestUrinalysis{$i}->receiptNumber;
            $dumper->receipt_type = $labRequestUrinalysis{$i}->receiptType;
            $dumper->waiver_no = '';
            $dumper->system_id = "sanitas";
            $dumper->save();
        }
        $this->command->info('ExternalDump table seeded');


        //  Begin seed for prevalence rates report
        /* Test Categories table - These map on to the lab sections */
        $lab_section_hematology = TestCategory::create(array("name" => "HEMATOLOGY","description" => ""));
        $lab_section_serology = TestCategory::create(array("name" => "SEROLOGY","description" => ""));
        $lab_section_trans = TestCategory::create(array("name" => "BLOOD TRANSFUSION","description" => ""));
        $this->command->info('Lab Sections seeded');

        /* Test Types for prevalence */
        $test_types_salmonella = TestType::create(array("name" => "Salmonella Antigen Test", "test_category_id" => $test_categories->id));
        $test_types_direct = TestType::create(array("name" => "Direct COOMBS Test", "test_category_id" => $lab_section_trans->id));
        $test_types_du = TestType::create(array("name" => "DU Test", "test_category_id" => $lab_section_trans->id));
        $test_types_sickling = TestType::create(array("name" => "Sickling Test", "test_category_id" => $lab_section_hematology->id));
        $test_types_borrelia = TestType::create(array("name" => "Borrelia", "test_category_id" => $test_categories->id));
        $test_types_vdrl = TestType::create(array("name" => "VDRL", "test_category_id" => $lab_section_serology->id));
        $test_types_pregnancy = TestType::create(array("name" => "Pregnancy Test", "test_category_id" => $lab_section_serology->id));
        $test_types_brucella = TestType::create(array("name" => "Brucella", "test_category_id" => $lab_section_serology->id));
        $test_types_pylori = TestType::create(array("name" => "H. Pylori", "test_category_id" => $lab_section_serology->id));

        $this->command->info('Test Types seeded');

        /* Test Types and specimen types relationship for prevalence */
        DB::insert('INSERT INTO testtype_specimentypes (test_type_id, specimen_type_id) VALUES (?, ?)', 
            array($test_types_salmonella->id, "13"));
        DB::insert('INSERT INTO testtype_specimentypes (test_type_id, specimen_type_id) VALUES (?, ?)', 
            array($test_types_direct->id, "23"));
        DB::insert('INSERT INTO testtype_specimentypes (test_type_id, specimen_type_id) VALUES (?, ?)', 
            array($test_types_du->id, "23"));
         DB::insert('INSERT INTO testtype_specimentypes (test_type_id, specimen_type_id) VALUES (?, ?)', 
            array($test_types_sickling->id, "23"));
        DB::insert('INSERT INTO testtype_specimentypes (test_type_id, specimen_type_id) VALUES (?, ?)', 
            array($test_types_borrelia->id, "23"));
        DB::insert('INSERT INTO testtype_specimentypes (test_type_id, specimen_type_id) VALUES (?, ?)', 
            array($test_types_vdrl->id, "13"));
         DB::insert('INSERT INTO testtype_specimentypes (test_type_id, specimen_type_id) VALUES (?, ?)', 
            array($test_types_pregnancy->id, "20"));
        DB::insert('INSERT INTO testtype_specimentypes (test_type_id, specimen_type_id) VALUES (?, ?)', 
            array($test_types_brucella->id, "13"));
        DB::insert('INSERT INTO testtype_specimentypes (test_type_id, specimen_type_id) VALUES (?, ?)', 
            array($test_types_pylori->id, "13"));
        DB::insert('INSERT INTO testtype_specimentypes (test_type_id, specimen_type_id) VALUES (?, ?)', 
            array($testTypeStoolCS->id, "16"));
        $this->command->info('TestTypes/SpecimenTypes seeded');
        
        /*New measures for prevalence*/
        $measure_salmonella = Measure::create(array("measure_type_id" => "2", "name" => "Salmonella Antigen Test", "unit" => ""));
        $measure_direct = Measure::create(array("measure_type_id" => "2", "name" => "Direct COOMBS Test", "unit" => ""));
        $measure_du = Measure::create(array("measure_type_id" => "2", "name" => "Du Test", "unit" => ""));
        $measure_sickling = Measure::create(array("measure_type_id" => "2", "name" => "Sickling Test", "unit" => ""));
        $measure_borrelia = Measure::create(array("measure_type_id" => "2", "name" => "Borrelia", "unit" => ""));
        $measure_vdrl = Measure::create(array("measure_type_id" => "2", "name" => "VDRL", "unit" => ""));
        $measure_pregnancy = Measure::create(array("measure_type_id" => "2", "name" => "Pregnancy Test", "unit" => ""));
        $measure_brucella = Measure::create(array("measure_type_id" => "2", "name" => "Brucella", "unit" => ""));
        $measure_pylori = Measure::create(array("measure_type_id" => "2", "name" => "H. Pylori", "unit" => ""));
        MeasureRange::create(array("measure_id" => $measure_salmonella->id, "alphanumeric" => "Positive"));
        MeasureRange::create(array("measure_id" => $measure_salmonella->id, "alphanumeric" => "Negative"));
        MeasureRange::create(array("measure_id" => $measure_direct->id, "alphanumeric" => "Positive"));
        MeasureRange::create(array("measure_id" => $measure_direct->id, "alphanumeric" => "Negative"));
        MeasureRange::create(array("measure_id" => $measure_du->id, "alphanumeric" => "Positive"));
        MeasureRange::create(array("measure_id" => $measure_du->id, "alphanumeric" => "Negative"));
        MeasureRange::create(array("measure_id" => $measure_sickling->id, "alphanumeric" => "Positive"));
        MeasureRange::create(array("measure_id" => $measure_sickling->id, "alphanumeric" => "Negative"));
        MeasureRange::create(array("measure_id" => $measure_borrelia->id, "alphanumeric" => "Positive"));
        MeasureRange::create(array("measure_id" => $measure_borrelia->id, "alphanumeric" => "Negative"));
        MeasureRange::create(array("measure_id" => $measure_vdrl->id, "alphanumeric" => "Positive"));
        MeasureRange::create(array("measure_id" => $measure_vdrl->id, "alphanumeric" => "Negative"));
        MeasureRange::create(array("measure_id" => $measure_pregnancy->id, "alphanumeric" => "Positive"));
        MeasureRange::create(array("measure_id" => $measure_pregnancy->id, "alphanumeric" => "Negative"));
        MeasureRange::create(array("measure_id" => $measure_brucella->id, "alphanumeric" => "Positive"));
        MeasureRange::create(array("measure_id" => $measure_brucella->id, "alphanumeric" => "Negative"));
        MeasureRange::create(array("measure_id" => $measure_pylori->id, "alphanumeric" => "Positive"));
        MeasureRange::create(array("measure_id" => $measure_pylori->id, "alphanumeric" => "Negative"));
        $this->command->info('Measures seeded again');

        /* TestType Measure for prevalence */
        $testtype_measure = TestTypeMeasure::create(array("test_type_id" => $test_types_salmonella->id, "measure_id" => $measure_salmonella->id));
        $testtype_measure = TestTypeMeasure::create(array("test_type_id" => $test_types_direct->id, "measure_id" => $measure_direct->id));
        $testtype_measure = TestTypeMeasure::create(array("test_type_id" => $test_types_du->id, "measure_id" => $measure_du->id));
        $testtype_measure = TestTypeMeasure::create(array("test_type_id" => $test_types_sickling->id, "measure_id" => $measure_sickling->id));
        $testtype_measure = TestTypeMeasure::create(array("test_type_id" => $test_types_borrelia->id, "measure_id" => $measure_borrelia->id));
        $testtype_measure = TestTypeMeasure::create(array("test_type_id" => $test_types_vdrl->id, "measure_id" => $measure_vdrl->id));
        $testtype_measure = TestTypeMeasure::create(array("test_type_id" => $test_types_pregnancy->id, "measure_id" => $measure_pregnancy->id));
        $testtype_measure = TestTypeMeasure::create(array("test_type_id" => $test_types_brucella->id, "measure_id" => $measure_brucella->id));
        $testtype_measure = TestTypeMeasure::create(array("test_type_id" => $test_types_pylori->id, "measure_id" => $measure_pylori->id));
        $this->command->info('Test Type Measures seeded again');

        /*  Tests for prevalence rates  */
        $tests_completed_one = Test::create(array(
                "visit_id" => "1",
                "test_type_id" => $test_types_salmonella->id,
                "specimen_id" => "4",
                "interpretation" => "Budda Boss",
                "test_status_id" => Test::COMPLETED,
                "created_by" => "2",
                "tested_by" => "3",
                "requested_by" => "Ariel Smith",
                "time_created" => "2014-07-23 15:16:15",
                "time_started" => "2014-07-23 16:07:15",
                "time_completed" => "2014-07-23 16:17:19",
            )
        );
        $tests_completed_two = Test::create(array(
                "visit_id" => "2",
                "test_type_id" => $test_types_direct->id,
                "specimen_id" => "3",
                "interpretation" => "Budda Boss",
                "test_status_id" => Test::COMPLETED,
                "created_by" => "2",
                "tested_by" => "3",
                "requested_by" => "Ariel Smith",
                "time_created" => "2014-07-26 10:16:15",
                "time_started" => "2014-07-26 13:27:15",
                "time_completed" => "2014-07-26 13:57:01",
            )
        );
        $tests_completed_three = Test::create(array(
                "visit_id" => "3",
                "test_type_id" => $test_types_du->id,
                "specimen_id" => "2",
                "interpretation" => "Budda Boss",
                "test_status_id" => Test::COMPLETED,
                "created_by" => "2",
                "tested_by" => "3",
                "requested_by" => "Ariel Smith",
                "time_created" => "2014-08-13 09:16:15",
                "time_started" => "2014-08-13 10:07:15",
                "time_completed" => "2014-08-13 10:18:11",
            )
        );
        $tests_completed_four = Test::create(array(
                "visit_id" => "4",
                "test_type_id" => $test_types_sickling->id,
                "specimen_id" => "1",
                "interpretation" => "Budda Boss",
                "test_status_id" => Test::COMPLETED,
                "created_by" => "2",
                "tested_by" => "3",
                "requested_by" => "Ariel Smith",
                "time_created" => "2014-08-16 09:06:53",
                "time_started" => "2014-08-16 09:09:15",
                "time_completed" => "2014-08-16 09:23:37",
            )
        );
        $tests_completed_five = Test::create(array(
                "visit_id" => "5",
                "test_type_id" => $test_types_borrelia->id,
                "specimen_id" => "1",
                "interpretation" => "Budda Boss",
                "test_status_id" => Test::COMPLETED,
                "created_by" => "2",
                "tested_by" => "3",
                "requested_by" => "Ariel Smith",
                "time_created" => "2014-08-23 10:16:15",
                "time_started" => "2014-08-23 11:54:39",
                "time_completed" => "2014-08-23 12:07:18",
            )
        );
        $tests_completed_six = Test::create(array(
                "visit_id" => "6",
                "test_type_id" => $test_types_vdrl->id,
                "specimen_id" => "2",
                "interpretation" => "Budda Boss",
                "test_status_id" => Test::COMPLETED,
                "created_by" => "2",
                "tested_by" => "3",
                "requested_by" => "Ariel Smith",
                "time_created" => "2014-09-07 07:23:15",
                "time_started" => "2014-09-07 08:07:20",
                "time_completed" => "2014-09-07 08:41:13",
            )
        );
        $tests_completed_seven = Test::create(array(
                "visit_id" => "7",
                "test_type_id" => $test_types_pregnancy->id,
                "specimen_id" => "3",
                "interpretation" => "Budda Boss",
                "test_status_id" => Test::COMPLETED,
                "created_by" => "2",
                "tested_by" => "3",
                "requested_by" => "Ariel Smith",
                "time_created" => "2014-10-03 11:52:15",
                "time_started" => "2014-10-03 12:31:04",
                "time_completed" => "2014-10-03 12:45:18",
            )
        );
        $tests_completed_eight = Test::create(array(
                "visit_id" => "1",
                "test_type_id" => $test_types_brucella->id,
                "specimen_id" => "4",
                "interpretation" => "Budda Boss",
                "test_status_id" => Test::COMPLETED,
                "created_by" => "2",
                "tested_by" => "3",
                "requested_by" => "Ariel Smith",
                "time_created" => "2014-10-15 17:01:15",
                "time_started" => "2014-10-15 17:05:24",
                "time_completed" => "2014-10-15 18:07:15",
            )
        );
        $tests_completed_nine = Test::create(array(
                "visit_id" => "2",
                "test_type_id" => $test_types_pylori->id,
                "specimen_id" => "4",
                "interpretation" => "Budda Boss",
                "test_status_id" => Test::COMPLETED,
                "created_by" => "2",
                "tested_by" => "3",
                "requested_by" => "Ariel Smith",
                "time_created" => "2014-10-23 16:06:15",
                "time_started" => "2014-10-23 16:07:15",
                "time_completed" => "2014-10-23 16:39:02",
            )
        );
        $tests_completed_ten = Test::create(array(
                "visit_id" => "4",
                "test_type_id" => $test_types_salmonella->id,
                "specimen_id" => "3",
                "interpretation" => "Budda Boss",
                "test_status_id" => Test::COMPLETED,
                "created_by" => "2",
                "tested_by" => "3",
                "requested_by" => "Ariel Smith",
                "time_created" => "2014-10-21 19:16:15",
                "time_started" => "2014-10-21 19:17:15",
                "time_completed" => "2014-10-21 19:52:40",
            )
        );     
        
        $tests_verified_one = Test::create(
            array(
                "visit_id" => "3",
                "test_type_id" => $test_types_direct->id,
                "specimen_id" => "2",
                "interpretation" => "Budda Boss",
                "test_status_id" => Test::VERIFIED,
                "created_by" => "3",
                "tested_by" => "2",
                "verified_by" => "3",
                "requested_by" => "Genghiz Khan",
                "time_created" => "2014-07-21 19:16:15",
                "time_started" => "2014-07-21 19:17:15",
                "time_completed" => "2014-07-21 19:52:40",
                "time_verified" => "2014-07-21 19:53:48",
            )
        );
        $tests_verified_two = Test::create(
            array(
                "visit_id" => "2",
                "test_type_id" => $test_types_du->id,
                "specimen_id" => "1",
                "interpretation" => "Budda Boss",
                "test_status_id" => Test::VERIFIED,
                "created_by" => "3",
                "tested_by" => "2",
                "verified_by" => "3",
                "requested_by" => "Genghiz Khan",
                "time_created" => "2014-08-21 19:16:15",
                "time_started" => "2014-08-21 19:17:15",
                "time_completed" => "2014-08-21 19:52:40",
                "time_verified" => "2014-08-21 19:53:48",
            )
        );
        $tests_verified_three = Test::create(
            array(
                "visit_id" => "3",
                "test_type_id" => $test_types_sickling->id,
                "specimen_id" => "4",
                "interpretation" => "Budda Boss",
                "test_status_id" => Test::VERIFIED,
                "created_by" => "3",
                "tested_by" => "2",
                "verified_by" => "3",
                "requested_by" => "Genghiz Khan",
                "time_created" => "2014-08-26 19:16:15",
                "time_started" => "2014-08-26 19:17:15",
                "time_completed" => "2014-08-26 19:52:40",
                "time_verified" => "2014-08-26 19:53:48",
            )
        );
        $tests_verified_four = Test::create(
            array(
                "visit_id" => "4",
                "test_type_id" => $test_types_borrelia->id,
                "specimen_id" => "2",
                "interpretation" => "Budda Boss",
                "test_status_id" => Test::VERIFIED,
                "created_by" => "3",
                "tested_by" => "2",
                "verified_by" => "3",
                "requested_by" => "Genghiz Khan",
                "time_created" => "2014-09-21 19:16:15",
                "time_started" => "2014-09-21 19:17:15",
                "time_completed" => "2014-09-21 19:52:40",
                "time_verified" => "2014-09-21 19:53:48",
            )
        );
        $tests_verified_five = Test::create(
            array(
                "visit_id" => "1",
                "test_type_id" => $test_types_vdrl->id,
                "specimen_id" => "3",
                "interpretation" => "Budda Boss",
                "test_status_id" => Test::VERIFIED,
                "created_by" => "3",
                "tested_by" => "2",
                "verified_by" => "3",
                "requested_by" => "Genghiz Khan",
                "time_created" => "2014-09-22 19:16:15",
                "time_started" => "2014-09-22 19:17:15",
                "time_completed" => "2014-09-22 19:52:40",
                "time_verified" => "2014-09-22 19:53:48",
            )
        );
        $tests_verified_six = Test::create(
            array(
                "visit_id" => "1",
                "test_type_id" => $test_types_pregnancy->id,
                "specimen_id" => "4",
                "interpretation" => "Budda Boss",
                "test_status_id" => Test::VERIFIED,
                "created_by" => "3",
                "tested_by" => "2",
                "verified_by" => "3",
                "requested_by" => "Genghiz Khan",
                "time_created" => "2014-09-23 19:16:15",
                "time_started" => "2014-09-23 19:17:15",
                "time_completed" => "2014-09-23 19:52:40",
                "time_verified" => "2014-09-23 19:53:48",
            )
        );
        $tests_verified_seven = Test::create(
            array(
                "visit_id" => "1",
                "test_type_id" => $test_types_brucella->id,
                "specimen_id" => "2",
                "interpretation" => "Budda Boss",
                "test_status_id" => Test::VERIFIED,
                "created_by" => "3",
                "tested_by" => "2",
                "verified_by" => "3",
                "requested_by" => "Genghiz Khan",
                "time_created" => "2014-09-27 19:16:15",
                "time_started" => "2014-09-27 19:17:15",
                "time_completed" => "2014-09-27 19:52:40",
                "time_verified" => "2014-09-27 19:53:48",
            )
        );
        $tests_verified_eight = Test::create(
            array(
                "visit_id" => "3",
                "test_type_id" => $test_types_pylori->id,
                "specimen_id" => "4",
                "interpretation" => "Budda Boss",
                "test_status_id" => Test::VERIFIED,
                "created_by" => "3",
                "tested_by" => "2",
                "verified_by" => "3",
                "requested_by" => "Genghiz Khan",
                "time_created" => "2014-10-22 19:16:15",
                "time_started" => "2014-10-22 19:17:15",
                "time_completed" => "2014-10-22 19:52:40",
                "time_verified" => "2014-10-22 19:53:48",
            )
        );
        $tests_verified_nine = Test::create(
            array(
                "visit_id" => "4",
                "test_type_id" => $test_types_pregnancy->id,
                "specimen_id" => "3",
                "interpretation" => "Budda Boss",
                "test_status_id" => Test::VERIFIED,
                "created_by" => "3",
                "tested_by" => "2",
                "verified_by" => "3",
                "requested_by" => "Genghiz Khan",
                "time_created" => "2014-10-17 19:16:15",
                "time_started" => "2014-10-17 19:17:15",
                "time_completed" => "2014-10-17 19:52:40",
                "time_verified" => "2014-10-17 19:53:48",
            )
        );
        $tests_verified_ten = Test::create(
            array(
                "visit_id" => "2",
                "test_type_id" => $test_types_pregnancy->id,
                "specimen_id" => "1",
                "interpretation" => "Budda Boss",
                "test_status_id" => Test::VERIFIED,
                "created_by" => "3",
                "tested_by" => "2",
                "verified_by" => "3",
                "requested_by" => "Genghiz Khan",
                "time_created" => "2014-10-02 19:16:15",
                "time_started" => "2014-10-02 19:17:15",
                "time_completed" => "2014-10-02 19:52:40",
                "time_verified" => "2014-10-02 19:53:48",
            )
        );
        $this->command->info('Tests seeded again');
        //  Test results for prevalence
        $results = array(
            array(
                "test_id" => $tests_completed_one->id,
                "measure_id" => $measure_salmonella->id,//BS for MPS
                "result" => "Positive",
            ),
            array(
                "test_id" => $tests_completed_two->id,
                "measure_id" => $measure_direct->id,
                "result" => "Positive",
            ),
            array(
                "test_id" => $tests_completed_three->id,
                "measure_id" => $measure_du->id,
                "result" => "Positive",
            ),
            array(
                "test_id" => $tests_completed_four->id,
                "measure_id" => $measure_sickling->id,
                "result" => "Positive",
            ),
             array(
                "test_id" => $tests_completed_five->id,
                "measure_id" => $measure_borrelia->id,//BS for MPS
                "result" => "Positive",
            ),
            array(
                "test_id" => $tests_completed_six->id,
                "measure_id" => $measure_vdrl->id,
                "result" => "Positive",
            ),
            array(
                "test_id" => $tests_completed_seven->id,
                "measure_id" => $measure_pregnancy->id,
                "result" => "Positive",
            ),
            array(
                "test_id" => $tests_completed_eight->id,
                "measure_id" => $measure_brucella->id,
                "result" => "Positive",
            ),
             array(
                "test_id" => $tests_completed_nine->id,
                "measure_id" => $measure_pylori->id,//BS for MPS
                "result" => "Positive",
            ),
            array(
                "test_id" => $tests_completed_ten->id,
                "measure_id" => $measure_salmonella->id,
                "result" => "Positive",
            ),
            array(
                "test_id" => $tests_verified_one->id,
                "measure_id" => $measure_direct->id,
                "result" => "Negative",
            ),
            array(
                "test_id" => $tests_verified_two->id,
                "measure_id" => $measure_du->id,
                "result" => "Positive",
            ),
             array(
                "test_id" => $tests_verified_three->id,
                "measure_id" => $measure_sickling->id,//BS for MPS
                "result" => "Positive",
            ),
            array(
                "test_id" => $tests_verified_four->id,
                "measure_id" => $measure_borrelia->id,
                "result" => "Negative",
            ),
            array(
                "test_id" => $tests_verified_five->id,
                "measure_id" => $measure_vdrl->id,
                "result" => "Negative",
            ),
            array(
                "test_id" => $tests_verified_six->id,
                "measure_id" => $measure_pregnancy->id,
                "result" => "Negative",
            ),
             array(
                "test_id" => $tests_verified_seven->id,
                "measure_id" => $measure_brucella->id,//BS for MPS
                "result" => "Positive",
            ),
            array(
                "test_id" => $tests_verified_eight->id,
                "measure_id" => $measure_pylori->id,
                "result" => "Positive",
            ),
            array(
                "test_id" => $tests_verified_nine->id,
                "measure_id" => $measure_pregnancy->id,
                "result" => "Negative",
            ),
            array(
                "test_id" => $tests_verified_ten->id,
                "measure_id" => $measure_pregnancy->id,
                "result" => "Positive",
            ),
        );        
        foreach ($results as $result)
        {
            TestResult::create($result);
        }
        $this->command->info('Test results seeded again');
        //  End prevalence rates seed

        //Seed for facilities
        $facilitiesSeed = array(
            array('name' => "WALTER REED"),
            array('name' => "AGA KHAN UNIVERSITY HOSPITAL"),
            array('name' => "TEL AVIV GENERAL HOSPITAL"),
            array('name' => "GK PRISON DISPENSARY"),
            array('name' => "KEMRI ALUPE"),
            array('name' => "AMPATH")
        );

        foreach ($facilitiesSeed as $facility) {
            Facility::create($facility);
        }
        $this->command->info('Facilities table seeded');

        //Seed for suppliers
        $supplier = Supplier::create(
            array(
                "name" => "UNICEF",
                "phone_no" => "0775112233",
                "user_id" => "1",
                "email" => "uni@unice.org",
                "address" => "un-hqtr"

            )
        );
        $this->command->info('Suppliers table seeded');

        //Seed for metrics
        $metric = Metric::create(
            array(
                "name" => "mg",
                "description" => "milligram"
            )
        );
        $this->command->info('Metrics table seeded');

        //Seed for commodities
        $commodity = Commodity::create(
            array(
                "name" => "Ampicillin",
                "description" => "Capsule 250mg",
                "metric_id" => $metric->id,
                "unit_price" => "500",
                "item_code" => "no clue",
                "storage_req" => "no clue",
                "min_level" => "100000",
                "max_level" => "400000")
        );
        $this->command->info('Commodities table seeded');
        
        //Seed for receipts
        $receipt = Receipt::create(
            [
                "commodity_id" => $commodity->id,
                "supplier_id" => $supplier->id, 
                "quantity" => "130000",
                "batch_no" => "002720",
                // todo : is this entry neccesary, coz we need to add it to the db
                // "user_id" => "1"
                "expiry_date" => "2018-10-14", ]
        );
        $this->command->info('Receipts table seeded');
        
        //Seed for Top Up Request
        $topUpRequest = TopupRequest::create(
            array(
                "commodity_id" => $commodity->id,
                "test_category_id" => 1,
                "order_quantity" => "1500",
                "user_id" => 1,
                "remarks" => "-")
        );
        $this->command->info('Top Up Requests table seeded');

        //Seed for Issues
        Issue::create(
            array(
                "receipt_id" => $receipt->id,
                "topup_request_id" => $topUpRequest->id,
                "quantity_issued" => "1700",
                "issued_to" => 1,
                "user_id" => 1,
                "remarks" => "-")
        );
        $this->command->info('Issues table seeded');

        //Seed for diseases
        $malaria = Disease::create(array('name' => "Malaria"));
        $typhoid = Disease::create(array('name' => "Typhoid"));
        $dysentry = Disease::create(array('name' => "Shigella Dysentry"));

        $this->command->info("Dieases table seeded");

        $reportDiseases = array(
            array(
                "test_type_id" => $testTypeBS->id,
                "disease_id" => $malaria->id,
                ),
             array(
                "test_type_id" => $test_types_salmonella->id,
                "disease_id" => $typhoid->id,
                ),
             array(
                "test_type_id" => $testTypeStoolCS->id,
                "disease_id" => $dysentry->id,
                ),
        );

        foreach ($reportDiseases as $reportDisease) {
            ReportDisease::create($reportDisease);
        }
        $this->command->info("Report Disease table seeded");

        //Seeding for QC
        $lots = array(
            array('number'=> '0001',
                'description' => 'First lot',
                'expiry' => date('Y-m-d H:i:s', strtotime("+6 months")),
                'instrument_id' => 1),
            array('number'=> '0002',
                'description' => 'Second lot',
                'expiry' => date('Y-m-d H:i:s', strtotime("+7 months")),
                'instrument_id' => 1));
        foreach ($lots as $lot) {
            $lot = Lot::create($lot);
        }
        $this->command->info("Lot table seeded");

        //Control seeding
        $controls = array(
            array('name'=>'Humatrol P', 
                    'description' =>'HUMATROL P control serum has been designed to provide a suitable basis for the quality control (imprecision, inaccuracy) in the clinical chemical laboratory.', 
                    'lot_id' => 1),
            array('name'=>'Full Blood Count', 'description' => 'Né pas touchér', 'lot_id' => 1,)
            );
        foreach ($controls as $control) {
            Control::create($control);
        }
        $this->command->info("Control table seeded");

        //Control measures
        $controlMeasures = array(
                    //Humatrol P
                    array('name' => 'ca', 'unit' => 'mmol', 'control_id' => 1, 'control_measure_type_id' => 1),
                    array('name' => 'pi', 'unit' => 'mmol', 'control_id' => 1, 'control_measure_type_id' => 1),
                    array('name' => 'mg', 'unit' => 'mmol', 'control_id' => 1, 'control_measure_type_id' => 1),
                    array('name' => 'na', 'unit' => 'mmol', 'control_id' => 1, 'control_measure_type_id' => 1),
                    array('name' => 'K', 'unit' => 'mmol', 'control_id' => 1, 'control_measure_type_id' => 1),

                    //Full Blood Count
                    array('name' => 'WBC', 'unit' => 'x 103/uL', 'control_id' => 2, 'control_measure_type_id' => 1),
                    array('name' => 'RBC', 'unit' => 'x 106/uL', 'control_id' => 2, 'control_measure_type_id' => 1),
                    array('name' => 'HGB', 'unit' => 'g/dl', 'control_id' => 2, 'control_measure_type_id' => 1),
                    array('name' => 'HCT', 'unit' => '%', 'control_id' => 2, 'control_measure_type_id' => 1),
                    array('name' => 'MCV', 'unit' => 'fl', 'control_id' => 2, 'control_measure_type_id' => 1),
                    array('name' => 'MCH', 'unit' => 'pg', 'control_id' => 2, 'control_measure_type_id' => 1),
                    array('name' => 'MCHC', 'unit' => 'g/dl', 'control_id' => 2, 'control_measure_type_id' => 1),
                    array('name' => 'PLT', 'unit' => 'x 103/uL', 'control_id' => 2, 'control_measure_type_id' => 1),
            );
        foreach ($controlMeasures as $controlMeasure) {
            ControlMeasure::create($controlMeasure);
        }
        $this->command->info("Control Measure table seeded");

        //Control measure ranges
        $controlMeasureRanges = array(
                //Humatrol P
                array('upper_range' => '2.63', 'lower_range' => '7.19', 'control_measure_id' => 1),
                array('upper_range' => '11.65', 'lower_range' => '15.43', 'control_measure_id' => 2),
                array('upper_range' => '12.13', 'lower_range' => '19.11', 'control_measure_id' => 3),
                array('upper_range' => '15.73', 'lower_range' => '25.01', 'control_measure_id' => 4),
                array('upper_range' => '17.63', 'lower_range' => '20.12', 'control_measure_id' => 5),

                //Full blood count
                array('upper_range' => '6.5', 'lower_range' => '7.5', 'control_measure_id' => 6),
                array('upper_range' => '4.36', 'lower_range' => '5.78', 'control_measure_id' => 7),
                array('upper_range' => '13.8', 'lower_range' => '17.3', 'control_measure_id' => 8),
                array('upper_range' => '81.0', 'lower_range' => '95.0', 'control_measure_id' => 9),
                array('upper_range' => '1.99', 'lower_range' => '2.63', 'control_measure_id' => 10),
                array('upper_range' => '27.6', 'lower_range' => '33.0', 'control_measure_id' => 11),
                array('upper_range' => '32.8', 'lower_range' => '36.4', 'control_measure_id' => 12),
                array('upper_range' => '141', 'lower_range' => ' 320.0', 'control_measure_id' => 13)
            );
        foreach ($controlMeasureRanges as $controlMeasureRange) {
            ControlMeasureRange::create($controlMeasureRange);
        }
        $this->command->info("Control Measure ranges table seeded");

        //Control Tests
        $controlTests = array(
                array('entered_by'=> 3, 'control_id'=> 1, 'created_at'=>date('Y-m-d', strtotime('-10 days'))),
                array('entered_by'=> 3, 'control_id'=> 1, 'created_at'=>date('Y-m-d', strtotime('-9 days'))),
                array('entered_by'=> 3, 'control_id'=> 1, 'created_at'=>date('Y-m-d', strtotime('-8 days'))),
                array('entered_by'=> 3, 'control_id'=> 1, 'created_at'=>date('Y-m-d', strtotime('-7 days'))),
                array('entered_by'=> 3, 'control_id'=> 1, 'created_at'=>date('Y-m-d', strtotime('-6 days'))),
                array('entered_by'=> 3, 'control_id'=> 1, 'created_at'=>date('Y-m-d', strtotime('-5 days'))),
                array('entered_by'=> 3, 'control_id'=> 1, 'created_at'=>date('Y-m-d', strtotime('-4 days'))),
                array('entered_by'=> 1, 'control_id'=> 2, 'created_at'=>date('Y-m-d', strtotime('-3 days'))),
                array('entered_by'=> 1, 'control_id'=> 2, 'created_at'=>date('Y-m-d', strtotime('-2 days'))),
            );
        foreach ($controlTests as $controltest) {
            ControlTest::create($controltest);
        }
        $this->command->info("Control test table seeded");

        //Control results
        $controlResults = array(
                //Results fro Humatrol P
                array('results' => '2.78', 'control_measure_id' => 1, 'control_test_id' => 1, 'created_at'=>date('Y-m-d', strtotime('-10 days'))),
                array('results' => '13.56', 'control_measure_id' => 2, 'control_test_id' => 1, 'created_at'=>date('Y-m-d', strtotime('-10 days'))),
                array('results' => '14.77', 'control_measure_id' => 3, 'control_test_id' => 1, 'created_at'=>date('Y-m-d', strtotime('-10 days'))),
                array('results' => '25.92', 'control_measure_id' => 4, 'control_test_id' => 1, 'created_at'=>date('Y-m-d', strtotime('-10 days'))),
                array('results' => '18.87', 'control_measure_id' => 5, 'control_test_id' => 1, 'created_at'=>date('Y-m-d', strtotime('-10 days'))),

                 //Results fro Humatrol P
                array('results' => '6.78', 'control_measure_id' => 1, 'control_test_id' => 2, 'created_at'=>date('Y-m-d', strtotime('-9 days'))),
                array('results' => '15.56', 'control_measure_id' => 2, 'control_test_id' => 2, 'created_at'=>date('Y-m-d', strtotime('-9 days'))),
                array('results' => '18.77', 'control_measure_id' => 3, 'control_test_id' => 2, 'created_at'=>date('Y-m-d', strtotime('-9 days'))),
                array('results' => '30.92', 'control_measure_id' => 4, 'control_test_id' => 2, 'created_at'=>date('Y-m-d', strtotime('-9 days'))),
                array('results' => '17.87', 'control_measure_id' => 5, 'control_test_id' => 2, 'created_at'=>date('Y-m-d', strtotime('-9 days'))),

                 //Results fro Humatrol P
                array('results' => '8.78', 'control_measure_id' => 1, 'control_test_id' => 3, 'created_at'=>date('Y-m-d', strtotime('-8 days'))),
                array('results' => '17.56', 'control_measure_id' => 2, 'control_test_id' => 3, 'created_at'=>date('Y-m-d', strtotime('-8 days'))),
                array('results' => '21.77', 'control_measure_id' => 3, 'control_test_id' => 3, 'created_at'=>date('Y-m-d', strtotime('-8 days'))),
                array('results' => '27.92', 'control_measure_id' => 4, 'control_test_id' => 3, 'created_at'=>date('Y-m-d', strtotime('-8 days'))),
                array('results' => '22.87', 'control_measure_id' => 5, 'control_test_id' => 3, 'created_at'=>date('Y-m-d', strtotime('-8 days'))),

                 //Results fro Humatrol P
                array('results' => '6.78', 'control_measure_id' => 1, 'control_test_id' => 4, 'created_at'=>date('Y-m-d', strtotime('-7 days'))),
                array('results' => '18.56', 'control_measure_id' => 2, 'control_test_id' => 4, 'created_at'=>date('Y-m-d', strtotime('-7 days'))),
                array('results' => '19.77', 'control_measure_id' => 3, 'control_test_id' => 4, 'created_at'=>date('Y-m-d', strtotime('-7 days'))),
                array('results' => '12.92', 'control_measure_id' => 4, 'control_test_id' => 4, 'created_at'=>date('Y-m-d', strtotime('-7 days'))),
                array('results' => '22.87', 'control_measure_id' => 5, 'control_test_id' => 4, 'created_at'=>date('Y-m-d', strtotime('-7 days'))),

                 //Results fro Humatrol P
                array('results' => '3.78', 'control_measure_id' => 1, 'control_test_id' => 5, 'created_at'=>date('Y-m-d', strtotime('-6 days'))),
                array('results' => '16.56', 'control_measure_id' => 2, 'control_test_id' => 5, 'created_at'=>date('Y-m-d', strtotime('-6 days'))),
                array('results' => '17.77', 'control_measure_id' => 3, 'control_test_id' => 5, 'created_at'=>date('Y-m-d', strtotime('-6 days'))),
                array('results' => '28.92', 'control_measure_id' => 4, 'control_test_id' => 5, 'created_at'=>date('Y-m-d', strtotime('-6 days'))),
                array('results' => '19.87', 'control_measure_id' => 5, 'control_test_id' => 5, 'created_at'=>date('Y-m-d', strtotime('-6 days'))),

                 //Results fro Humatrol P
                array('results' => '5.78', 'control_measure_id' => 1, 'control_test_id' => 6, 'created_at'=>date('Y-m-d', strtotime('-5 days'))),
                array('results' => '15.56', 'control_measure_id' => 2, 'control_test_id' => 6, 'created_at'=>date('Y-m-d', strtotime('-5 days'))),
                array('results' => '11.77', 'control_measure_id' => 3, 'control_test_id' => 6, 'created_at'=>date('Y-m-d', strtotime('-5 days'))),
                array('results' => '29.92', 'control_measure_id' => 4, 'control_test_id' => 6, 'created_at'=>date('Y-m-d', strtotime('-5 days'))),
                array('results' => '14.87', 'control_measure_id' => 5, 'control_test_id' => 6, 'created_at'=>date('Y-m-d', strtotime('-5 days'))),

                 //Results fro Humatrol P
                array('results' => '9.78', 'control_measure_id' => 1, 'control_test_id' => 7, 'created_at'=>date('Y-m-d', strtotime('-4 days'))),
                array('results' => '11.56', 'control_measure_id' => 2, 'control_test_id' => 7, 'created_at'=>date('Y-m-d', strtotime('-4 days'))),
                array('results' => '19.77', 'control_measure_id' => 3, 'control_test_id' => 7, 'created_at'=>date('Y-m-d', strtotime('-4 days'))),
                array('results' => '32.92', 'control_measure_id' => 4, 'control_test_id' => 7, 'created_at'=>date('Y-m-d', strtotime('-4 days'))),
                array('results' => '29.87', 'control_measure_id' => 5, 'control_test_id' => 7, 'created_at'=>date('Y-m-d', strtotime('-4 days'))),

                //Results for Full blood count
                array('results' => '5.45', 'control_measure_id' => 6, 'control_test_id' => 8, 'created_at'=>date('Y-m-d', strtotime('-3 days'))),
                array('results' => '5.01', 'control_measure_id' => 7, 'control_test_id' => 8, 'created_at'=>date('Y-m-d', strtotime('-3 days'))),
                array('results' => '12.3', 'control_measure_id' => 8, 'control_test_id' => 8, 'created_at'=>date('Y-m-d', strtotime('-3 days'))),
                array('results' => '89.7', 'control_measure_id' => 9, 'control_test_id' => 8, 'created_at'=>date('Y-m-d', strtotime('-3 days'))),
                array('results' => '2.15', 'control_measure_id' => 10, 'control_test_id' => 8, 'created_at'=>date('Y-m-d', strtotime('-3 days'))),
                array('results' => '34.0', 'control_measure_id' => 11, 'control_test_id' => 8, 'created_at'=>date('Y-m-d', strtotime('-3 days'))),
                array('results' => '37.2', 'control_measure_id' => 12, 'control_test_id' => 8, 'created_at'=>date('Y-m-d', strtotime('-3 days'))),
                array('results' => '141.5', 'control_measure_id' => 13, 'control_test_id' => 8, 'created_at'=>date('Y-m-d', strtotime('-3 days'))),

                //Results for Full blood count
                array('results' => '7.45', 'control_measure_id' => 6, 'control_test_id' => 9, 'created_at'=>date('Y-m-d', strtotime('-2 days'))),
                array('results' => '9.01', 'control_measure_id' => 7, 'control_test_id' => 9, 'created_at'=>date('Y-m-d', strtotime('-2 days'))),
                array('results' => '9.3',  'control_measure_id' => 8, 'control_test_id' => 9, 'created_at'=>date('Y-m-d', strtotime('-2 days'))),
                array('results' => '94.7', 'control_measure_id' => 9, 'control_test_id' => 9, 'created_at'=>date('Y-m-d', strtotime('-2 days'))),
                array('results' => '12.15','control_measure_id' => 10, 'control_test_id' => 9, 'created_at'=>date('Y-m-d', strtotime('-2 days'))),
                array('results' => '37.0', 'control_measure_id' => 11, 'control_test_id' => 9, 'created_at'=>date('Y-m-d', strtotime('-2 days'))),
                array('results' => '30.2', 'control_measure_id' => 12, 'control_test_id' => 9, 'created_at'=>date('Y-m-d', strtotime('-2 days'))),
                array('results' => '121.5','control_measure_id' =>  13, 'control_test_id' => 9, 'created_at'=>date('Y-m-d', strtotime('-2 days'))),
            );
        
        foreach ($controlResults as $controlResult) {
            ControlMeasureResult::create($controlResult);
        }
        $this->command->info("Control results table seeded");

        //Seed for drugs
        $penicillin = Drug::create(array('name' => "PENICILLIN"));
        $ampicillin = Drug::create(array('name' => "AMPICILLIN"));
        $clindamycin = Drug::create(array('name' => "CLINDAMYCIN"));
        $tetracycline = Drug::create(array('name' => "TETRACYCLINE"));
        $ciprofloxacin = Drug::create(array('name' => "CIPROFLOXACIN"));
        $trimeth = Drug::create(array('name' => "TRIMETHOPRIM/SULFA"));
        $nitrofurantoin = Drug::create(array('name' => "NITROFURANTOIN"));
        $chloramphenicol = Drug::create(array('name' => "CHLORAMPHENICOL"));
        $cefazolin = Drug::create(array('name' => "CEFAZOLIN"));
        $gentamicin = Drug::create(array('name' => "GENTAMICIN"));
        $amoxicillin = Drug::create(array('name' => "AMOXICILLIN-CLAV"));
        $cephalothin = Drug::create(array('name' => "CEPHALOTHIN"));
        $cefuroxime = Drug::create(array('name' => "CEFUROXIME"));
        $cefotaxime = Drug::create(array('name' => "CEFOTAXIME"));
        $piperacillin = Drug::create(array('name' => "PIPERACILLIN"));
        $cefixime = Drug::create(array('name' => "CEFIXIME"));
        $ceftazidime = Drug::create(array('name' => "CEFTAZIDIME"));
        $cefriaxone = Drug::create(array('name' => "CEFRIAXONE"));
        $levofloxacin = Drug::create(array('name' => "LEVOFLOXACIN"));
        $merodenem = Drug::create(array('name' => "MERODENEM"));
        $tazo = Drug::create(array('name' => "PIPERACILLIN/TAZO"));
        $imedenem = Drug::create(array('name' => "IMEDENEM"));
        $oxacillin = Drug::create(array('name' => "OXACILLIN (CEFOXITIN)"));
        $erythromycin = Drug::create(array('name' => "ERYTHROMYCIN"));
        $vancomycin = Drug::create(array('name' => "VANCOMYCIN"));
        $cefoxitin = Drug::create(array('name' => "CEFOXITIN"));
        $tobramycin = Drug::create(array('name' => "TOBRAMYCIN"));
        $sulbactam = Drug::create(array('name' => "AMPICILLIN-SULBACTAM"));
        
        $this->command->info('Drugs table seeded');
        //Seed for organisims
        $staphylococci = Organism::create(array('name' => "Staphylococci species"));
        $gramnegative = Organism::create(array('name' => "Gram negative cocci"));
        $pseudomonas = Organism::create(array('name' => "Pseudomonas aeruginosa"));
        $enterococcus = Organism::create(array('name' => "Enterococcus species"));
        $pneumoniae = Organism::create(array('name' => "Streptococcus pneumoniae"));
        $streptococcus = Organism::create(array('name' => "Streptococcus species viridans group"));
        $beta = Organism::create(array('name' => "Beta-haemolytic streptococci"));
        $haemophilus = Organism::create(array('name' => "Haemophilus influenzae"));
        $naisseria = Organism::create(array('name' => "Naisseria menengitidis"));
        $salmonella = Organism::create(array('name' => "Salmonella species"));
        $shigella = Organism::create(array('name' => "Shigella"));
        $vibrio = Organism::create(array('name' => "Vibrio cholerae"));
        $grampositive = Organism::create(array('name' => "Gram positive cocci"));

        $this->command->info('Organisms table seeded');

        // todo: keep kalm kitsao will sort this out ;)
        //  Seed for organism_drugs
        //  Staphylococci species
      /*  DB::table('organism_drugs')->insert(
            array("organism_id" => $staphylococci->id, "drug_id" => $penicillin->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $staphylococci->id, "drug_id" => $oxacillin->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $staphylococci->id, "drug_id" => $cefoxitin->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $staphylococci->id, "drug_id" => $erythromycin->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $staphylococci->id, "drug_id" => $clindamycin->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $staphylococci->id, "drug_id" => $trimeth->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $staphylococci->id, "drug_id" => $cefazolin->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $staphylococci->id, "drug_id" => $cephalothin->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $staphylococci->id, "drug_id" => $chloramphenicol->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $staphylococci->id, "drug_id" => $nitrofurantoin->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $staphylococci->id, "drug_id" => $tetracycline->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $staphylococci->id, "drug_id" => $vancomycin->id));
        
        $this->command->info('Staphylococci species seeded');

        //  Gram negative cocci
        DB::table('organism_drugs')->insert(
            array("organism_id" => $gramnegative->id, "drug_id" => $ampicillin->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $gramnegative->id, "drug_id" => $cefazolin->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $gramnegative->id, "drug_id" => $gentamicin->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $gramnegative->id, "drug_id" => $amoxicillin->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $gramnegative->id, "drug_id" => $cephalothin->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $gramnegative->id, "drug_id" => $cefuroxime->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $gramnegative->id, "drug_id" => $cefotaxime->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $gramnegative->id, "drug_id" => $ciprofloxacin->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $gramnegative->id, "drug_id" => $trimeth->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $gramnegative->id, "drug_id" => $nitrofurantoin->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $gramnegative->id, "drug_id" => $chloramphenicol->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $gramnegative->id, "drug_id" => $tetracycline->id));
        
        $this->command->info('Gram negative cocci seeded');

        //  Pseudomonas aeruginosa
        DB::table('organism_drugs')->insert(
            array("organism_id" => $pseudomonas->id, "drug_id" => $ceftazidime->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $pseudomonas->id, "drug_id" => $gentamicin->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $pseudomonas->id, "drug_id" => $tobramycin->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $pseudomonas->id, "drug_id" => $piperacillin->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $pseudomonas->id, "drug_id" => $ciprofloxacin->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $pseudomonas->id, "drug_id" => $merodenem->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $pseudomonas->id, "drug_id" => $tazo->id));

        $this->command->info('Pseudomonas aeruginosa seeded');

        //  Enterococcus species
        DB::table('organism_drugs')->insert(
            array("organism_id" => $enterococcus->id, "drug_id" => $ampicillin->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $enterococcus->id, "drug_id" => $gentamicin->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $enterococcus->id, "drug_id" => $nitrofurantoin->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $enterococcus->id, "drug_id" => $ciprofloxacin->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $enterococcus->id, "drug_id" => $tetracycline->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $enterococcus->id, "drug_id" => $chloramphenicol->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $enterococcus->id, "drug_id" => $vancomycin->id));
        
        $this->command->info('Enterococcus species seeded');

        //  Streptococcus pneumoniae
        DB::table('organism_drugs')->insert(
            array("organism_id" => $pneumoniae->id, "drug_id" => $penicillin->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $pneumoniae->id, "drug_id" => $cefriaxone->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $pneumoniae->id, "drug_id" => $cefuroxime->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $pneumoniae->id, "drug_id" => $erythromycin->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $pneumoniae->id, "drug_id" => $trimeth->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $pneumoniae->id, "drug_id" => $chloramphenicol->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $pneumoniae->id, "drug_id" => $tetracycline->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $pneumoniae->id, "drug_id" => $levofloxacin->id));
        
        $this->command->info('Streptococcus pneumoniae seeded');

        //  Streptococcus species viridans group
        DB::table('organism_drugs')->insert(
            array("organism_id" => $streptococcus->id, "drug_id" => $penicillin->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $streptococcus->id, "drug_id" => $cefriaxone->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $streptococcus->id, "drug_id" => $vancomycin->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $streptococcus->id, "drug_id" => $chloramphenicol->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $streptococcus->id, "drug_id" => $clindamycin->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $streptococcus->id, "drug_id" => $erythromycin->id));
        
        $this->command->info('Streptococcus species viridans group seeded');

        //  Beta-haemolytic streptococci
        DB::table('organism_drugs')->insert(
            array("organism_id" => $beta->id, "drug_id" => $penicillin->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $beta->id, "drug_id" => $erythromycin->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $beta->id, "drug_id" => $clindamycin->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $beta->id, "drug_id" => $cefriaxone->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $beta->id, "drug_id" => $chloramphenicol->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $beta->id, "drug_id" => $vancomycin->id));
        
        $this->command->info('Beta-haemolytic streptococci seeded');

        //  Haemophilus influenzae
        DB::table('organism_drugs')->insert(
            array("organism_id" => $haemophilus->id, "drug_id" => $ampicillin->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $haemophilus->id, "drug_id" => $trimeth->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $haemophilus->id, "drug_id" => $sulbactam->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $haemophilus->id, "drug_id" => $cefriaxone->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $haemophilus->id, "drug_id" => $chloramphenicol->id));
        
        $this->command->info('Haemophilus influenzae seeded');

        //  Naisseria menengitidis
        DB::table('organism_drugs')->insert(
            array("organism_id" => $naisseria->id, "drug_id" => $penicillin->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $naisseria->id, "drug_id" => $cefriaxone->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $naisseria->id, "drug_id" => $chloramphenicol->id));
        
        $this->command->info('Neisseria menengitidis seeded');

        //  Salmonella species
        DB::table('organism_drugs')->insert(
            array("organism_id" => $salmonella->id, "drug_id" => $ampicillin->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $salmonella->id, "drug_id" => $ciprofloxacin->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $salmonella->id, "drug_id" => $trimeth->id));
        
        $this->command->info('Salmonella species seeded');

        //  Shigella
        DB::table('organism_drugs')->insert(
            array("organism_id" => $shigella->id, "drug_id" => $ampicillin->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $shigella->id, "drug_id" => $ciprofloxacin->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $shigella->id, "drug_id" => $trimeth->id));
        
        $this->command->info('Shigella seeded');

        //  Vibrio cholerae
        DB::table('organism_drugs')->insert(
            array("organism_id" => $vibrio->id, "drug_id" => $ampicillin->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $vibrio->id, "drug_id" => $ciprofloxacin->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $vibrio->id, "drug_id" => $trimeth->id));
        
        $this->command->info('Vibrio cholerae seeded');

        //  Gram positive cocci
        DB::table('organism_drugs')->insert(
            array("organism_id" => $grampositive->id, "drug_id" => $cefoxitin->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $grampositive->id, "drug_id" => $clindamycin->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $grampositive->id, "drug_id" => $erythromycin->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $grampositive->id, "drug_id" => $oxacillin->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $grampositive->id, "drug_id" => $penicillin->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $grampositive->id, "drug_id" => $tetracycline->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $grampositive->id, "drug_id" => $trimeth->id));
        DB::table('organism_drugs')->insert(
            array("organism_id" => $grampositive->id, "drug_id" => $vancomycin->id));
        
      */  $this->command->info('Gram positive cocci seeded');

        $role1 = Role::find(1);
        $role2 = Role::find(2);//Technologist
        $permissions = Permission::all();
        

        //Assign all permissions to role administrator
        foreach ($permissions as $permission) {
            $role1->attachPermission($permission);
        }
        //Assign role Administrator to administrators
        User::find(1)->attachRole($role1);
        User::find(2)->attachRole($role2);
        // User::find(8)->attachRole($role1);
        // User::find(10)->attachRole($role1);



        //Assign technologist's permissions to role technologist
        $role2->attachPermission(Permission::find(1));
        $role2->attachPermission(Permission::find(2));
        $role2->attachPermission(Permission::find(3));
        $role2->attachPermission(Permission::find(4));
        $role2->attachPermission(Permission::find(5));
        $role2->attachPermission(Permission::find(6));
        $role2->attachPermission(Permission::find(7));
        $role2->attachPermission(Permission::find(8));
        $role2->attachPermission(Permission::find(9));
        $role2->attachPermission(Permission::find(10));
        $role2->attachPermission(Permission::find(11));
        $role2->attachPermission(Permission::find(12));
        $role2->attachPermission(Permission::find(13));
        $role2->attachPermission(Permission::find(17));

        //Assign role Technologist to the other users
        // User::find(5)->attachRole($role2);
        // User::find(12)->attachRole($role2);
        // User::find(18)->attachRole($role2);
        // User::find(23)->attachRole($role2);
        // User::find(24)->attachRole($role2);
        // User::find(26)->attachRole($role2);
        // User::find(29)->attachRole($role2);
        // User::find(43)->attachRole($role2);
        // User::find(76)->attachRole($role2);
        // User::find(136)->attachRole($role2);
        // User::find(159)->attachRole($role2);
        // User::find(161)->attachRole($role2);
        // User::find(162)->attachRole($role2);
        // User::find(163)->attachRole($role2);
        // User::find(164)->attachRole($role2);


        /* Configurables table */
        $configurables = array(
            array(
                "name" => "Barcode Settings", "Description" => "", "route" => "barcode", "user_id" => "1", "created_at" => $now, "updated_at" => $now
            ),
            array(
                "name" => "Laboratory Settings", "Description" => "", "route" => "lab", "user_id" => "1", "created_at" => $now, "updated_at" => $now
            )
        );
        /* fields table */
        $fields = array(
        	// Barcode fields
            array(
                "field_name" => "Encoding Format", "field_type" => "3", "user_id" => "1", "options" => "ean8,ean13,code11,code39,code128,codabar,std25,int25,code93", "created_at" => $now, "updated_at" => $now
            ),
            array(
                "field_name" => "Barcode Width", "field_type" => "3", "user_id" => "1", "options" => "1,2,3,4,5,6,7,8,9,10", "created_at" => $now, "updated_at" => $now
            ),
            array(
                "field_name" => "Barcode Height", "field_type" => "3", "user_id" => "1", "options" => "5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80", "created_at" => $now, "updated_at" => $now
            ),
            array(
                "field_name" => "Text Size", "field_type" => "3", "user_id" => "1", "options" => "5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39", "created_at" => $now, "updated_at" => $now
            ),
            // Lab settings fields
            array(
                "field_name" => "Laboratory Logo", "field_type" => "1", "user_id" => "1", "created_at" => $now, "updated_at" => $now
            ),
            array(
                "field_name" => "Laboratory Name", "field_type" => "4", "user_id" => "1", "created_at" => $now, "updated_at" => $now
            ),
            array(
                "field_name" => "Telephone", "field_type" => "4", "user_id" => "1", "created_at" => $now, "updated_at" => $now
            ),
            array(
                "field_name" => "Address", "field_type" => "5", "user_id" => "1", "created_at" => $now, "updated_at" => $now
            ),
            array(
                "field_name" => "Email", "field_type" => "4", "user_id" => "1", "created_at" => $now, "updated_at" => $now
            ),
            array(
                "field_name" => "Website", "field_type" => "4", "user_id" => "1", "created_at" => $now, "updated_at" => $now
            ),
            array(
                "field_name" => "Director", "field_type" => "4", "user_id" => "1", "created_at" => $now, "updated_at" => $now
            ),
            array(
                "field_name" => "Manager", "field_type" => "4", "user_id" => "1", "created_at" => $now, "updated_at" => $now
            ),
            array(
                "field_name" => "Quality Manager", "field_type" => "4", "user_id" => "1", "created_at" => $now, "updated_at" => $now
            )
            // interfaced equipment
            ,
            array(
                "field_name" => "PORT", "field_type" => "4", "user_id" => "1", "created_at" => $now, "updated_at" => $now
            ),
            array(
                "field_name" => "MODE", "field_type" => "4", "user_id" => "1", "created_at" => $now, "updated_at" => $now
            ),
            array(
                "field_name" => "CLIENT_RECONNECT", "field_type" => "4", "user_id" => "1", "created_at" => $now, "updated_at" => $now
            ),
            array(
                "field_name" => "EQUIPMENT_IP", "field_type" => "4", "user_id" => "1", "created_at" => $now, "updated_at" => $now
            ),
            array(
                "field_name" => "COMPORT", "field_type" => "4", "user_id" => "1", "created_at" => $now, "updated_at" => $now
            ),
            array(
                "field_name" => "BAUD_RATE", "field_type" => "3", "user_id" => "1", "options" => "300,1200,2400,4800,9600,14400,19200,28800,38400,57600,115200,230400", "created_at" => $now, "updated_at" => $now
            ),
            array(
                "field_name" => "PARITY", "field_type" => "3", "user_id" => "1", "options" => "None,Odd,Even", "created_at" => $now, "updated_at" => $now
            ),
            array(
                "field_name" => "STOP_BITS", "field_type" => "4", "user_id" => "1", "created_at" => $now, "updated_at" => $now
            ),
            array(
                "field_name" => "APPEND_NEWLINE", "field_type" => "4", "user_id" => "1", "created_at" => $now, "updated_at" => $now
            ),
            array(
                "field_name" => "DATA_BITS", "field_type" => "4", "user_id" => "1", "created_at" => $now, "updated_at" => $now
            ),
            array(
                "field_name" => "APPEND_CARRIAGE_RETURN", "field_type" => "4", "user_id" => "1", "created_at" => $now, "updated_at" => $now
            ),
            array(
                "field_name" => "DATASOURCE", "field_type" => "4", "user_id" => "1", "created_at" => $now, "updated_at" => $now
            ),
            array(
                "field_name" => "DAYS", "field_type" => "4", "user_id" => "1", "created_at" => $now, "updated_at" => $now
            ),
            array(
                "field_name" => "BASE_DIRECTORY", "field_type" => "4", "user_id" => "1", "created_at" => $now, "updated_at" => $now
            ),
            array(
                "field_name" => "USE_SUB_DIRECTORIES", "field_type" => "4", "user_id" => "1", "created_at" => $now, "updated_at" => $now
            ),
            array(
                "field_name" => "SUB_DIRECTORY_FORMAT", "field_type" => "4", "user_id" => "1", "created_at" => $now, "updated_at" => $now
            ),
            array(
                "field_name" => "FILE_NAME_FORMAT", "field_type" => "4", "user_id" => "1", "created_at" => $now, "updated_at" => $now
            ),
            array(
                "field_name" => "FILE_EXTENSION", "field_type" => "4", "user_id" => "1", "created_at" => $now, "updated_at" => $now
            ),
            array(
                "field_name" => "FILE_SEPERATOR", "field_type" => "4", "user_id" => "1", "created_at" => $now, "updated_at" => $now
            )
        );
		/* configurable-fields table */
		$confields = array(
			array(
				"configurable_id" => 1, "field_id" => 1, "user_id" => "1", "created_at" => $now, "updated_at" => $now
			),
			array(
				"configurable_id" => 1, "field_id" => 2, "user_id" => "1", "created_at" => $now, "updated_at" => $now
			),
			array(
				"configurable_id" => 1, "field_id" => 3, "user_id" => "1", "created_at" => $now, "updated_at" => $now
			),
			array(
				"configurable_id" => 1, "field_id" => 4, "user_id" => "1", "created_at" => $now, "updated_at" => $now
			),
			array(
				"configurable_id" => 2, "field_id" => 5, "user_id" => "1", "created_at" => $now, "updated_at" => $now
			),
			array(
				"configurable_id" => 2, "field_id" => 6, "user_id" => "1", "created_at" => $now, "updated_at" => $now
			),
			array(
				"configurable_id" => 2, "field_id" => 7, "user_id" => "1", "created_at" => $now, "updated_at" => $now
			),
			array(
				"configurable_id" => 2, "field_id" => 8, "user_id" => "1", "created_at" => $now, "updated_at" => $now
			),
			array(
				"configurable_id" => 2, "field_id" => 9, "user_id" => "1", "created_at" => $now, "updated_at" => $now
			),
			array(
				"configurable_id" => 2, "field_id" => 10, "user_id" => "1", "created_at" => $now, "updated_at" => $now
			),
			array(
				"configurable_id" => 2, "field_id" => 11, "user_id" => "1", "created_at" => $now, "updated_at" => $now
			),
			array(
				"configurable_id" => 2, "field_id" => 12, "user_id" => "1", "created_at" => $now, "updated_at" => $now
			),
			array(
				"configurable_id" => 2, "field_id" => 13, "user_id" => "1", "created_at" => $now, "updated_at" => $now
			)
		);
        /* lab-config-settings table */
        $settings = array(
            array(
                "key" => "1", "value" => "code39", "user_id" => "1", "created_at" => $now, "updated_at" => $now
            ),
            array(
                "key" => "2", "value" => "2", "user_id" => "1", "created_at" => $now, "updated_at" => $now
            ),
            array(
                "key" => "3", "value" => "30", "user_id" => "1", "created_at" => $now, "updated_at" => $now
            ),
            array(
                "key" => "4", "value" => "11", "user_id" => "1", "created_at" => $now, "updated_at" => $now
            )
        );
        /* lnterfaced-equipment table */
        $analysers = array(
            array(
                "name" => "Mindray BS-200E", "version" => "01.00.07", "comm_type" => "1", "feed_source" => "2", "test_category_id" => "1", "config_file" => "", "user_id" => "1", "created_at" => $now, "updated_at" => $now
            ),
            array(
                "name" => "ABX Pentra 60 C+", "version" => "", "comm_type" => "1", "feed_source" => "3", "test_category_id" => "1", "config_file" => "", "user_id" => "1", "created_at" => $now, "updated_at" => $now
            ),
            array(
                "name" => "ABX MACROS 60", "version" => "", "comm_type" => "0", "feed_source" => "1", "test_category_id" => "1", "config_file" => "", "user_id" => "1", "created_at" => $now, "updated_at" => $now
            ),
            array(
                "name" => "BT 3000 Plus", "version" => "", "comm_type" => "0", "feed_source" => "1", "test_category_id" => "1", "config_file" => "", "user_id" => "1", "created_at" => $now, "updated_at" => $now
            ),
            array(
                "name" => "Sysmex SX 500i", "version" => "", "comm_type" => "0", "feed_source" => "2", "test_category_id" => "1", "config_file" => "", "user_id" => "1", "created_at" => $now, "updated_at" => $now
            ),
            array(
                "name" => "BD FACSCalibur", "version" => "", "comm_type" => "1", "feed_source" => "5", "test_category_id" => "1", "config_file" => "", "user_id" => "1", "created_at" => $now, "updated_at" => $now
            ),
            array(
                "name" => "Mindray BC 3600", "version" => "", "comm_type" => "0", "feed_source" => "1", "test_category_id" => "1", "config_file" => "", "user_id" => "1", "created_at" => $now, "updated_at" => $now
            ),
            array(
                "name" => "Selectra Junior", "version" => "", "comm_type" => "0", "feed_source" => "1", "test_category_id" => "1", "config_file" => "", "user_id" => "1", "created_at" => $now, "updated_at" => $now
            ),
            array(
                "name" => "GeneXpert", "version" => "", "comm_type" => "1", "feed_source" => "2", "test_category_id" => "1", "config_file" => "", "user_id" => "1", "created_at" => $now, "updated_at" => $now
            ),
            array(
                "name" => "ABX Pentra 80", "version" => "", "comm_type" => "1", "feed_source" => "1", "test_category_id" => "1", "config_file" => "", "user_id" => "1", "created_at" => $now, "updated_at" => $now
            ),
            array(
                "name" => "Sysmex XT 2000i", "version" => "", "comm_type" => "0", "feed_source" => "2", "test_category_id" => "1", "config_file" => "", "user_id" => "1", "created_at" => $now, "updated_at" => $now
            ),
            array(
                "name" => "Vitalex Flexor", "version" => "", "comm_type" => "0", "feed_source" => "2", "test_category_id" => "1", "config_file" => "", "user_id" => "1", "created_at" => $now, "updated_at" => $now
            )
        );

        $this->command->info('Users table seeded');
        foreach ($configurables as $configurable)
        {
            $data[] = Configurable::create($configurable);
        }
        $this->command->info('Configurables table seeded');
        foreach ($fields as $field)
        {
            $configs[] = Field::create($field);
        }
        $this->command->info('Fields table seeded');
        foreach ($confields as $confield)
        {
            $conf[] = ConField::create($confield);
        }
        $this->command->info('Fields table seeded');
        foreach ($settings as $setting)
        {
            $array[] = LabConfig::create($setting);
        }
        $this->command->info('Settings table seeded');

        foreach ($analysers as $analyser)
        {
            $lyser[] = Analyser::create($analyser);
        }
        $this->command->info('Analysers table seeded');

        //Seed for charges
        $charge = Charge::create(["test_id" => "1", "current_amount" => '3000',]);
        $this->command->info('Charges table seeded');

        //Seed for charges
        $payment = Payment::create([
            "patient_id" => "1",
            "charge_id" => $charge->id,
            "full_amount" => "3000",
            "amount_paid" => "2500",
        ]);
        $this->command->info('Payments table seeded');

    }

    public function createSpecimen(
            $testStatus,
            $specimenStatus,
            $specimenTypeID,
            $acceptor = 0, $rejector = 0, $rejectReason = ""){

        $values["specimen_type_id"] = $specimenTypeID;
        $values["specimen_status_id"] = $specimenStatus;

        if($specimenStatus == Specimen::ACCEPTED){
            $values["accepted_by"] = $acceptor;
            $values["time_accepted"] = date('Y-m-d H:i:s');
        }
        if($specimenStatus == Specimen::REJECTED){
            $values["rejected_by"] = $rejector;
            $values["rejection_reason_id"] = $rejectReason;
            $values["time_rejected"] = date('Y-m-d H:i:s');
        }
        
        $specimen = Specimen::create($values);

        return $specimen->id;
    }

}
