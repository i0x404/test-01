@extends('layouts.app')

@section('content')
<div class="container" x-data="academiesData()">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="mb-3">Available Academies</h2>
            <p class="text-muted">Explore our academies and find the perfect learning path for you.</p>
        </div>
    </div>

    <div class="row g-4" x-show="!loading">
        <template x-for="academy in academies" :key="academy.id">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card academy-card h-100">
                    <img :src="academy.avatarUrl" class="card-img-top" :alt="academy.name">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title" x-text="academy.name"></h5>
                        <p class="card-text flex-grow-1" x-text="academy.shortDescription"></p>
                        <a :href="`/academy/${academy.id}`" class="btn btn-outline-primary mt-auto">View Details</a>
                    </div>
                </div>
            </div>
        </template>
    </div>

    <!-- Loading state -->
    <div class="row" x-show="loading">
        <div class="col-12 text-center py-5">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-3">Loading academies...</p>
        </div>
    </div>

    <!-- Error state -->
    <div class="row" x-show="error">
        <div class="col-12 text-center py-5">
            <div class="alert alert-danger" role="alert">
                <p x-text="errorMessage"></p>
                <button class="btn btn-outline-danger mt-3" @click="fetchAcademies">Try Again</button>
            </div>
        </div>
    </div>
</div>

<script>
    function academiesData() {
        return {
            academies: [],
            loading: true,
            error: false,
            errorMessage: '',
            
            init() {
                this.fetchAcademies();
            },
            
            fetchAcademies() {
                this.loading = true;
                this.error = false;
                
                // Simulated API call - replace with actual API endpoint
                axios.get('/api/academies')
                    .then(response => {
                        this.academies = response.data;
                        this.loading = false;
                    })
                    .catch(error => {
                        console.error('Error fetching academies:', error);
                        this.error = true;
                        this.errorMessage = 'Failed to load academies. Please try again later.';
                        this.loading = false;
                        
                        // For development: mock data when API is not available
                        if (process.env.NODE_ENV === 'development') {
                            this.mockAcademies();
                        }
                    });
            },
            
            // Mock data for development
            mockAcademies() {
                this.academies = [
                    {
                        id: 1,
                        name: 'Web Development Academy',
                        shortDescription: 'Learn modern web development with HTML, CSS, JavaScript and more.',
                        avatarUrl: 'https://placehold.co/600x400?text=Web+Dev'
                    },
                    {
                        id: 2,
                        name: 'Data Science Fundamentals',
                        shortDescription: 'Master the basics of data analysis, visualization, and machine learning.',
                        avatarUrl: 'https://placehold.co/600x400?text=Data+Science'
                    },
                    {
                        id: 3,
                        name: 'Mobile App Development',
                        shortDescription: 'Create native and cross-platform mobile applications for iOS and Android.',
                        avatarUrl: 'https://placehold.co/600x400?text=Mobile+Dev'
                    },
                    {
                        id: 4,
                        name: 'UI/UX Design Principles',
                        shortDescription: 'Learn to create beautiful, functional, and user-friendly interfaces.',
                        avatarUrl: 'https://placehold.co/600x400?text=UI/UX'
                    },
                    {
                        id: 5,
                        name: 'Cloud Computing',
                        shortDescription: 'Master cloud platforms, services, and deployment strategies.',
                        avatarUrl: 'https://placehold.co/600x400?text=Cloud'
                    },
                    {
                        id: 6,
                        name: 'Cybersecurity Essentials',
                        shortDescription: 'Learn to protect systems and networks from digital attacks.',
                        avatarUrl: 'https://placehold.co/600x400?text=Security'
                    }
                ];
                this.loading = false;
                this.error = false;
            }
        }
    }
</script>
@endsection
