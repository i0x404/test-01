@extends('layouts.app')

@section('content')
<div class="container" x-data="academyDetailsData()">
    <!-- Loading state -->
    <div class="row" x-show="loading">
        <div class="col-12 text-center py-5">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-3">Loading academy details...</p>
        </div>
    </div>

    <!-- Error state -->
    <div class="row" x-show="error">
        <div class="col-12 text-center py-5">
            <div class="alert alert-danger" role="alert">
                <p x-text="errorMessage"></p>
                <button class="btn btn-outline-danger mt-3" @click="fetchAcademyDetails">Try Again</button>
            </div>
        </div>
    </div>

    <!-- Academy details content -->
    <div x-show="!loading && !error">
        <!-- Academy header -->
        <div class="academy-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="display-5 fw-bold" x-text="academy.name"></h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <img :src="academy.imageUrl" class="academy-image" :alt="academy.name">
                
                <div class="mb-4">
                    <h3>About This Academy</h3>
                    <p class="lead" x-text="academy.fullDescription"></p>
                </div>
                
                <div class="mb-4">
                    <h3>Goals</h3>
                    <div x-html="formatGoals(academy.goals)"></div>
                </div>
                
                <div class="mb-4">
                    <h3>Target Audience</h3>
                    <p x-text="academy.targetAudience"></p>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h4 class="card-title">Academy Details</h4>
                        <ul class="list-unstyled">
                            <li class="mb-2"><strong>Duration:</strong> <span x-text="academy.duration"></span></li>
                            <li class="mb-2"><strong>Level:</strong> <span x-text="academy.level"></span></li>
                            <li class="mb-2"><strong>Format:</strong> <span x-text="academy.format"></span></li>
                        </ul>
                        
                        <button 
                            class="btn btn-primary w-100" 
                            @click="registerForAcademy" 
                            :disabled="registering">
                            <span x-show="registering" class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                            Register for Academy
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function academyDetailsData() {
        return {
            academy: {},
            academyId: {{ $id }},
            loading: true,
            error: false,
            errorMessage: '',
            registering: false,
            
            init() {
                this.fetchAcademyDetails();
            },
            
            fetchAcademyDetails() {
                this.loading = true;
                this.error = false;
                
                // Simulated API call - replace with actual API endpoint
                axios.get(`/api/academies/${this.academyId}`)
                    .then(response => {
                        this.academy = response.data;
                        this.loading = false;
                    })
                    .catch(error => {
                        console.error('Error fetching academy details:', error);
                        this.error = true;
                        this.errorMessage = 'Failed to load academy details. Please try again later.';
                        this.loading = false;
                        
                        // For development: mock data when API is not available
                        this.mockAcademyDetails();
                    });
            },
            
            registerForAcademy() {
                this.registering = true;
                
                // Simulated API call - replace with actual API endpoint
                axios.post(`/api/academies/${this.academyId}/register`)
                    .then(response => {
                        this.registering = false;
                        Swal.fire({
                            icon: 'success',
                            title: 'Registration Successful!',
                            text: 'You have successfully registered for this academy.',
                            confirmButtonColor: '#0d6efd'
                        }).then(() => {
                            window.location.href = '/dashboard';
                        });
                    })
                    .catch(error => {
                        this.registering = false;
                        Swal.fire({
                            icon: 'error',
                            title: 'Registration Failed',
                            text: error.response?.data?.message || 'There was an error processing your registration. Please try again.',
                            confirmButtonColor: '#0d6efd'
                        });
                    });
            },
            
            formatGoals(goals) {
                if (!goals || !Array.isArray(goals)) return '';
                return `<ul class="goals-list">
                    ${goals.map(goal => `<li>${goal}</li>`).join('')}
                </ul>`;
            },
            
            // Mock data for development
            mockAcademyDetails() {
                const mockAcademies = {
                    1: {
                        id: 1,
                        name: 'Web Development Academy',
                        imageUrl: 'https://placehold.co/1200x600?text=Web+Development',
                        shortDescription: 'Learn modern web development with HTML, CSS, JavaScript and more.',
                        fullDescription: 'Our comprehensive Web Development Academy provides you with all the skills needed to become a professional web developer. From front-end technologies like HTML, CSS, and JavaScript to back-end frameworks and databases, you\'ll learn everything you need to build modern, responsive websites and web applications.',
                        goals: [
                            'Master HTML5, CSS3, and modern JavaScript',
                            'Learn responsive design principles and frameworks',
                            'Build full-stack web applications',
                            'Deploy and maintain web projects',
                            'Understand web security best practices'
                        ],
                        targetAudience: 'This academy is perfect for beginners with no prior coding experience, as well as those looking to update their skills with modern web technologies.',
                        duration: '12 weeks',
                        level: 'Beginner to Intermediate',
                        format: 'Online with live sessions'
                    },
                    2: {
                        id: 2,
                        name: 'Data Science Fundamentals',
                        imageUrl: 'https://placehold.co/1200x600?text=Data+Science',
                        shortDescription: 'Master the basics of data analysis, visualization, and machine learning.',
                        fullDescription: 'The Data Science Fundamentals academy introduces you to the exciting world of data analysis and machine learning. You\'ll learn how to collect, clean, and analyze data, create meaningful visualizations, and build predictive models that can drive business decisions.',
                        goals: [
                            'Understand data collection and cleaning techniques',
                            'Master data visualization tools and methods',
                            'Learn statistical analysis and interpretation',
                            'Build and evaluate machine learning models',
                            'Apply data science to real-world problems'
                        ],
                        targetAudience: 'This academy is designed for analysts, business professionals, and anyone interested in leveraging data for better decision-making.',
                        duration: '10 weeks',
                        level: 'Intermediate',
                        format: 'Hybrid (online and in-person)'
                    }
                };
                
                // Use the academy ID from the route parameter to get the corresponding mock data
                if (mockAcademies[this.academyId]) {
                    this.academy = mockAcademies[this.academyId];
                    this.loading = false;
                    this.error = false;
                } else {
                    this.error = true;
                    this.errorMessage = 'Academy not found.';
                    this.loading = false;
                }
            }
        }
    }
</script>
@endsection
