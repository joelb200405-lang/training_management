<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// ── PUBLIC ROUTES (walang login needed) ──────────────────────────────────────
Route::get('/', [UserController::class, 'index'])->name('index');
Route::get("/login", [UserController::class, "Login"])->name("Login");
Route::post("/login", [UserController::class, "LoginUser"])->name("LoginUser");
Route::get("/sign_up", [UserController::class, "SignupPage"])->name("SignupPage");
Route::post("/signup-form", [UserController::class, "SignUp"])->name("SignUp");
Route::get("/handle", [UserController::class, "handle"])->name("handle");
Route::get("/adminlogin", [UserController::class, "adminlogin"])->name("adminlogin");
Route::post("/Logout", [UserController::class, "Logout"])->name("Logout");
Route::get("/about", [UserController::class, "landingAbout"])->name("landing.about");
Route::get("/contact-us", [UserController::class, "landingContact"])->name("landing.contact");
Route::post("/contact-us", [UserController::class, "landingContactSend"])->name("landing.contact.send");
Route::get("/our-courses/{id}", [UserController::class, "landingCourseDetail"])->name("landing.course.detail");

    // Email Verification
    Route::get('/email/verify', function () {
    return view('student.verify_email');
    })->middleware('auth')->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (\Illuminate\Foundation\Auth\EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect()->route('handle');
    })->middleware(['auth', 'signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (\Illuminate\Http\Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('status', 'verification-link-sent');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Forgot/Reset Password (public)
Route::get("/forgotpassword", [UserController::class, "ForgotPassword"])->name("ForgotPassword");
Route::post("/forgotpassword", [UserController::class, "SendResetLink"])->name("SendResetLink");
Route::get("/reset-password/{token}", [UserController::class, "ResetPasswordPage"])->name("ResetPasswordPage");
Route::post("/reset-password", [UserController::class, "ResetPassword"])->name("ResetPassword");

// First time login reset (auth only)
Route::get("/first-reset", [UserController::class, "firstResetPage"])->name("first.reset")->middleware("auth");
Route::post("/first-reset", [UserController::class, "firstResetSave"])->name("first.reset.save")->middleware("auth");

// ── ADMIN ROUTES ──────────────────────────────────────────────────────────────
Route::middleware("admin")->group(function () {
    Route::get("/admin1", [UserController::class, "admin1"])->name("admin1");
    Route::get("/trainees", [UserController::class, "trainees"])->name("trainees");

    // Trainer management
    Route::post("/admin/trainer/store", [UserController::class, "storeTrainer"])->name("admin.trainer.store");

    // Course management
    Route::post("/admin/course/{courseId}/assign-trainer", [UserController::class, "assignTrainer"])->name("admin.course.assignTrainer");
    Route::post("/admin/course/{courseId}/remove-trainer", [UserController::class, "removeTrainer"])->name("admin.course.removeTrainer");

    // Modules
    Route::get("/admin/course/{courseId}/content", [UserController::class, "getCourseContent"])->name("admin.course.content");
    Route::post("/admin/module", [UserController::class, "storeModule"])->name("admin.module.store");
    Route::match(['POST', 'DELETE'], "/admin/module/{id}", [UserController::class, "destroyModule"])->name("admin.module.destroy");

    // Quizzes
    Route::post("/admin/quiz", [UserController::class, "storeQuiz"])->name("admin.quiz.store");
    Route::match(['POST', 'DELETE'], "/admin/quiz/{id}", [UserController::class, "destroyQuiz"])->name("admin.quiz.destroy");

    // Quiz Questions
    Route::get("/admin/quiz/{quizId}/questions", [UserController::class, "getQuizQuestions"])->name("admin.quiz.questions");
    Route::post("/admin/quiz-question", [UserController::class, "storeQuizQuestion"])->name("admin.quiz.question.store");
    Route::match(['POST', 'DELETE'], "/admin/quiz-question/{id}", [UserController::class, "destroyQuizQuestion"])->name("admin.quiz.question.destroy");
});

// ── TRAINER ROUTES ────────────────────────────────────────────────────────────
Route::middleware("trainer")->group(function () {
    Route::get("/teacher", [UserController::class, "teacher"])->name("teacher");
    Route::get("/learner", [UserController::class, "learner"])->name("learner");
    Route::get("/trainer/courses", [UserController::class, "courses"])->name("trainer.courses");
    Route::get("/assessment", [UserController::class, "assessment"])->name("assessment");
    Route::get("/certificates", [UserController::class, "certificates"])->name("certificates");
    Route::get("/reports", [UserController::class, "reports"])->name("reports");
    Route::get("/settings", [UserController::class, "settings"])->name("settings");
    Route::get("/trainer/students", [UserController::class, "trainerStudents"])->name("trainer.students");
    Route::get("/trainer/schedule", [UserController::class, "trainerSchedule"])->name("trainer.schedule");
    Route::get("/trainer/profile", [UserController::class, "trainerProfile"])->name("trainer.profile");
    Route::post("/trainer/profile/update", [UserController::class, "trainerProfileUpdate"])->name("trainer.profile.update");
    Route::post("/trainer/profile/password", [UserController::class, "trainerProfilePassword"])->name("trainer.profile.password");
 

    // Trainer course content
    Route::get("/trainer/course/{courseId}/content", [UserController::class, "getCourseContent"])->name("trainer.course.content");
    Route::post("/trainer/module", [UserController::class, "storeModule"])->name("trainer.module.store");
    Route::match(['POST', 'DELETE'], "/trainer/module/{id}", [UserController::class, "destroyModule"])->name("trainer.module.destroy");
    Route::post("/trainer/quiz", [UserController::class, "storeQuiz"])->name("trainer.quiz.store");
    Route::match(['POST', 'DELETE'], "/trainer/quiz/{id}", [UserController::class, "destroyQuiz"])->name("trainer.quiz.destroy");
    Route::get("/trainer/quiz/{quizId}/questions", [UserController::class, "getQuizQuestions"])->name("trainer.quiz.questions");
    Route::post("/trainer/quiz-question", [UserController::class, "storeQuizQuestion"])->name("trainer.quiz.question.store");
    Route::match(['POST', 'DELETE'], "/trainer/quiz-question/{id}", [UserController::class, "destroyQuizQuestion"])->name("trainer.quiz.question.destroy");
});

// ── STUDENT ROUTES ────────────────────────────────────────────────────────────
Route::middleware("student")->group(function () {
    Route::get("/homepage", [UserController::class, "homepage"])->name("homepage");
    Route::get("/courses", [UserController::class, "allCourses"])->name("all.courses");
    Route::get("/courses/{id}", [UserController::class, "courseDetail"])->name("course.detail");
    Route::post("/courses/{id}/enroll", [UserController::class, "enroll"])->name("course.enroll");
    Route::get("/student/about", [UserController::class, "about"])->name("about");
    Route::get("/contact", [UserController::class, "contact"])->name("contact");
    Route::post("/contact", [UserController::class, "sendContact"])->name("contact.send");
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get("/student/quiz/{quizId}", [UserController::class, "getQuizForStudent"])->name("student.quiz.get");
    Route::post("/student/quiz/submit", [UserController::class, "submitQuiz"])->name("student.quiz.submit");
    Route::get("/student/profile", [UserController::class, "studentProfile"])->name("student.profile");
    Route::post("/student/profile/update", [UserController::class, "studentProfileUpdate"])->name("student.profile.update");
    Route::post("/student/profile/password", [UserController::class, "studentProfilePassword"])->name("student.profile.password");
    Route::get("/student/modules", [UserController::class, "studentModules"])->name("student.modules");

    // Announcements
    Route::get("/admin/announcements", [UserController::class, "admin1"])->name("admin.announcements");
    Route::post("/admin/announcement", [UserController::class, "storeAnnouncement"])->name("admin.announcement.store")->middleware("admin");
    Route::put("/admin/announcement/{id}", [UserController::class, "updateAnnouncement"])->name("admin.announcement.update")->middleware("admin");
    Route::delete("/admin/announcement/{id}", [UserController::class, "destroyAnnouncement"])->name("admin.announcement.destroy")->middleware("admin");
    Route::post("/admin/announcement/{id}/toggle", [UserController::class, "toggleAnnouncement"])->name("admin.announcement.toggle")->middleware("admin");
});