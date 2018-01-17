<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

    	/****************/
    	/**** ROLES ****/
    	/**************/

    	$userRoleID = DB::table('roles')->insertGetId(
    		['role' => "User"]);
    	$adminRoleID = DB::table('roles')->insertGetId(
    		['role' => "Admin"]);
    	$bannedRoleID = DB::table('roles')->insertGetId(
    		['role' => "Banned"]);

    	/*******************/
    	/**** PROFILES ****/
    	/*****************/

        $profileOneID = DB::table('profiles')->insertGetId(
				['realName' => "Random Name One",
				 'avatar' => "DatAvatar.jpg",
				 'created_at' => Carbon::now(),
				 'updated_at' => Carbon::now()]);

        $profileTwoID = DB::table('profiles')->insertGetId(
				['realName' => "Random Name Two",
				 'avatar' => "RandomAvatar.jpg",
				 'created_at' => Carbon::now(),
				 'updated_at' => Carbon::now()]);

        $profileThreeID = DB::table('profiles')->insertGetId(
				['realName' => "Random Name Three",
				 'avatar' => "RandomAva.jpg",
				 'created_at' => Carbon::now(),
				 'updated_at' => Carbon::now()]);

    	/****************/
    	/**** USERS ****/
    	/**************/

        $userOneID = DB::table('users')->insertGetId([
        	'username' => "User One",
        	'email' => "userone@hotmail.com",
        	'password' => bcrypt('secretOne'),
        	'userIP' => "185.97.228.26",
            'activated' => 1,
        	'profileID' => $profileOneID,
        	'roleID' => $adminRoleID,
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now()]);

        $userTwoID = DB::table('users')->insertGetId([
        	'username' => "User Two",
        	'email' => "usertwo@hotmail.com",
        	'password' => bcrypt('secretTwo'),
        	'userIP' => "185.98.288.66",
            'activated' => 0,
        	'profileID' => $profileTwoID,
        	'roleID' => $userRoleID,
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now()]);

        $userThreeID = DB::table('users')->insertGetId([
        	'username' => "User Three",
        	'email' => "userthree@hotmail.com",
        	'password' => bcrypt('secretThree'),
        	'userIP' => "185.99.999.98",
            'activated' => 1,
        	'profileID' => $profileThreeID,
        	'roleID' => $bannedRoleID,
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now()]);




        /*************************/
        /**** USERACTIVATION ****/
        /***********************/
        $randomString = str_random(30);
        DB::table('useractivations')->insert([
            'userID' => $userTwoID,
            'token' => $randomString,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ]);


        /*****************/
    	/**** SLIDER ****/
    	/***************/

    	DB::table('sliderimages')->insert([
    		'imageName' => "slider1.jpg",
    		'sliderTitle' => "Title One",
    		'sliderCaption' => "Caption One"]);
    	
    	DB::table('sliderimages')->insert([
    		'imageName' => "slider2.jpg",
    		'sliderTitle' => "Title Two",
    		'sliderCaption' => "Caption Two"]);

    	DB::table('sliderimages')->insert([
    		'imageName' => "slider3.jpg",
    		'sliderTitle' => "Title Three",
    		'sliderCaption' => "Caption Three"]);

    	DB::table('sliderimages')->insert([
    		'imageName' => "slider4.jpg",
    		'sliderTitle' => "Title Four",
    		'sliderCaption' => "Caption Four"]);

    	/***********************/
    	/**** ISOTOPETYPES ****/
    	/*********************/

    	$isoTypeOne = DB::table('isotopetypes')->insertGetId([
    		'type' => "Alles"
    	]);
    	$isoTypeTwo = DB::table('isotopetypes')->insertGetId([
    		'type' => "Taart"
    	]);
        $isoTypeThree = DB::table('isotopetypes')->insertGetId([
            'type' => "Decoratie"
        ]);
        $isoTypeFour = DB::table('isotopetypes')->insertGetId([
            'type' => "Geen"
        ]);

    	/************************/
    	/**** ISOTOPEIMAGES ****/
    	/**********************/

    	DB::table('isotopeimages')->insert([
    		'imageName' => "isotope1.jpg",
    		'isoTypeOne' => $isoTypeOne,
    		'isoTypeTwo' => NULL]);

    	DB::table('isotopeimages')->insert([
    		'imageName' => "isotope2.jpg",
    		'isoTypeOne' => $isoTypeTwo,
    		'isoTypeTwo' => NULL]);

    	DB::table('isotopeimages')->insert([
    		'imageName' => "isotope3.jpg",
    		'isoTypeOne' => $isoTypeTwo,
    		'isoTypeTwo' => $isoTypeThree]);

    	DB::table('isotopeimages')->insert([
    		'imageName' => "isotope4.jpg",
    		'isoTypeOne' => $isoTypeThree,
    		'isoTypeTwo' => NULL]);

        DB::table('isotopeimages')->insert([
            'imageName' => "isotope5.jpg",
            'isoTypeOne' => $isoTypeOne,
            'isoTypeTwo' => NULL]);

        DB::table('isotopeimages')->insert([
            'imageName' => "isotope6.jpg",
            'isoTypeOne' => $isoTypeTwo,
            'isoTypeTwo' => NULL]);

        DB::table('isotopeimages')->insert([
            'imageName' => "isotope7.jpg",
            'isoTypeOne' => $isoTypeOne,
            'isoTypeTwo' => $isoTypeTwo]);

        DB::table('isotopeimages')->insert([
            'imageName' => "isotope8.jpg",
            'isoTypeOne' => $isoTypeOne,
            'isoTypeTwo' => $isoTypeTwo]);

        DB::table('isotopeimages')->insert([
            'imageName' => "isotope9.jpg",
            'isoTypeOne' => $isoTypeTwo,
            'isoTypeTwo' => NULL]);

    	/*******************/
    	/**** BAKTYPES ****/
    	/*****************/

    	$bakTypeOne = DB::table('baktypes')->insertGetId([
    		'type' => "Taart"
    	]);
    	$bakTypeTwo = DB::table('baktypes')->insertGetId([
    		'type' => "Decoratie"
    	]);
    	$bakTypeThree = DB::table('baktypes')->insertGetId([
    		'type' => "Cupcake"
    	]);
        $bakTypeFour = DB::table('baktypes')->insertGetId([
            'type' => "Anders"
        ]);
    	/********************/
    	/**** BAKSTATUS ****/
    	/******************/

    	$bakStatusOne = DB::table('bakstatus')->insertGetId([
    		'status' => "Bezig",
            'colorCode' => "#e6770b"
    	]);
    	$bakStatusTwo = DB::table('bakstatus')->insertGetId([
    		'status' => "Compleet",
            'colorCode' => "#52d053"
    	]);
    	$bakStatusThree = DB::table('bakstatus')->insertGetId([
    		'status' => "Planning",
            'colorCode' => "#56a0d3"
    	]);

    	/************************/
    	/**** COMMENTSTATUS ****/
    	/**********************/

    	$commentStatusOne = DB::table('commentstatus')->insertGetId([
    		'status' => "Open",
            'colorCode' => "#52d053"
    	]);
    	$commentStatusTwo = DB::table('commentstatus')->insertGetId([
    		'status' => "Gesloten",
            'colorCode' => "#d3290f"
    	]);


        /***********************/
        /**** BAKSELPHOTOS ****/
        /*********************/

        /**** TAART ****/
        $bakselOnePhotos = DB::table('bakselphotos')->insertGetId([
            'photoOne' => "1491811657.jpg",
            'photoTwo' => "1491811659.jpg",
            'photoThree' => "1491811661.jpg",
            'photoFour' => "1491811663.jpg",]);

        /**** DECORATIE ****/
        $bakselTwoPhotos = DB::table('bakselphotos')->insertGetId([
            'photoOne' => "393119.jpg",
            'photoTwo' => "393120.jpg",
            'photoThree' => NULL,
            'photoFour' => NULL,]);

        /**** ANDERS ****/
        $bakselThreePhotos = DB::table('bakselphotos')->insertGetId([
            'photoOne' => "1488528049.jpg",
            'photoTwo' => "1488528050.jpg",
            'photoThree' => "1488528052.jpg",
            'photoFour' => "1488528053.jpg",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()]);

    	/******************/
    	/**** BAKSELS ****/
    	/****************/

        /**** TAART ****/
    	$bakselOne = DB::table('baksels')->insertGetId([
    		'title' => "Taart Een",
    		'description' => "Lorem ipsum dolor sit amet",
    		'timeSpend' => "9 uur",
    		'bakPhotosID' => $bakselOnePhotos,
    		'bakTypeID' => $bakTypeOne,
    		'bakStatusID' => $bakStatusOne,
    		'commentStatusID' => $commentStatusOne,
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now()
    	]);

        /**** DECORATIE ****/
    	$bakselTwo = DB::table('baksels')->insertGetId([
    		'title' => "Decoratie Een",
    		'description' => "Consectetur adipisicing elit",
    		'timeSpend' => "8 Uur",
    		'bakPhotosID' => $bakselTwoPhotos,
    		'bakTypeID' => $bakTypeTwo,
    		'bakStatusID' => $bakStatusTwo,
    		'commentStatusID' => $commentStatusTwo,
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now()
    	]);

        /**** ANDERS ****/
    	$bakselThree = DB::table('baksels')->insertGetId([
    		'title' => "Iets Anders",
    		'description' => "sed do eiusmod tempor incididunt ut labore",
    		'timeSpend' => "0 Uur",
    		'bakPhotosID' => $bakselThreePhotos,
    		'bakTypeID' => $bakTypeFour,
    		'bakStatusID' => $bakStatusThree,
    		'commentStatusID' => $commentStatusTwo,
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now()
    	]);


    	/*******************/
    	/**** COMMENTS ****/
    	/*****************/

 		DB::table('comments')->insert([
    		'comment' => "Consectetur adipisicing elit.",
    		'bakselID' => $bakselOne,
    		'postedBy' => $userOneID,
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now()]);

		DB::table('comments')->insert([
    		'comment' => "sed do eiusmod tempor incididunt ut labore.",
    		'bakselID' => $bakselOne,
    		'postedBy' => $userTwoID,
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now()]);

        DB::table('comments')->insert([
            'comment' => "Aenean commodo ligula eget dolor.",
            'bakselID' => $bakselOne,
            'postedBy' => $userTwoID,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()]);

        DB::table('comments')->insert([
            'comment' => "Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes.",
            'bakselID' => $bakselOne,
            'postedBy' => $userTwoID,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()]);

        DB::table('comments')->insert([
            'comment' => "nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu.",
            'bakselID' => $bakselOne,
            'postedBy' => $userTwoID,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()]);

        DB::table('comments')->insert([
            'comment' => "Nulla consequat massa quis enim. Donec pede justo, fringilla vel.",
            'bakselID' => $bakselOne,
            'postedBy' => $userTwoID,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()]);

        DB::table('comments')->insert([
            'comment' => "aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a.",
            'bakselID' => $bakselOne,
            'postedBy' => $userTwoID,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()]);

        DB::table('comments')->insert([
            'comment' => "Nullam dictum felis eu pede mollis pretium. Integer tincidunt.",
            'bakselID' => $bakselOne,
            'postedBy' => $userTwoID,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()]);


		DB::table('comments')->insert([
    		'comment' => "Lorem ipsum dolor sit amet",
    		'bakselID' => $bakselTwo,
    		'postedBy' => $userOneID,
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now()]);

		/*********************/
    	/**** BANNED IPS ****/
    	/*******************/

    	DB::table('bannedips')->insert([
    		'ipAdress' => "185.99.999.98",
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now()]);

        /*********************/
        /**** FRONTQUOTE ****/
        /*******************/

        DB::table('frontquotes')->insert([
            'imageName' => "frontPhoto.jpg",
            'quote' => "Lorem ipsum dolor sit amet",
            'updated_at' => Carbon::now()]);


    }
}