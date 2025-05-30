@extends('layouts.app')

@section('content')
<div class="container" x-data="dashboardData()">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="mb-3">Dashboard</h2>
            <p class="text-muted" x-text="welcomeMessage"></p>
        </div>
    </div>

    <!-- Admin Dashboard -->
    <div x-show="userType === 'admin'">
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Academy Management</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <button class="btn btn-primary">
                                    <i class="bi bi-plus-circle me-2"></i> Add New Academy
                                </button>
                            </div>
                            <div class="d-flex">
                                <input type="text" class="form-control me-2" placeholder="Search academies...">
                                <button class="btn btn-outline-secondary">Search</button>
                            </div>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Students</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template x-for="academy in adminAcademies" :key="academy.id">
                                        <tr>
                                            <td x-text="academy.id"></td>
                                            <td x-text="academy.name"></td>
                                            <td x-text="academy.students"></td>
                                            <td>
                                                <span 
                                                    class="badge" 
                                                    :class="academy.active ? 'bg-success' : 'bg-secondary'"
                                                    x-text="academy.active ? 'Active' : 'Inactive'">
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <button class="btn btn-outline-primary">Edit</button>
                                                    <button class="btn btn-outline-danger">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">User Statistics</h5>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-4">
                                <div class="dashboard-icon">
                                    <i class="bi bi-mortarboard"></i>
                                </div>
                                <h3 class="h4">245</h3>
                                <p class="text-muted">Students</p>
                            </div>
                            <div class="col-4">
                                <div class="dashboard-icon">
                                    <i class="bi bi-person-workspace"></i>
                                </div>
                                <h3 class="h4">18</h3>
                                <p class="text-muted">Teachers</p>
                            </div>
                            <div class="col-4">
                                <div class="dashboard-icon">
                                    <i class="bi bi-people"></i>
                                </div>
                                <h3 class="h4">56</h3>
                                <p class="text-muted">Parents</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Recent Activities</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item px-0">
                                <div class="d-flex justify-content-between">
                                    <span>New academy created: Data Science</span>
                                    <small class="text-muted">2 hours ago</small>
                                </div>
                            </li>
                            <li class="list-group-item px-0">
                                <div class="d-flex justify-content-between">
                                    <span>15 new students registered</span>
                                    <small class="text-muted">Yesterday</small>
                                </div>
                            </li>
                            <li class="list-group-item px-0">
                                <div class="d-flex justify-content-between">
                                    <span>Web Development academy updated</span>
                                    <small class="text-muted">2 days ago</small>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Student Dashboard -->
    <div x-show="userType === 'student'">
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">My Enrolled Academies</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            <template x-for="academy in studentAcademies" :key="academy.id">
                                <div class="col-md-6 col-lg-4">
                                    <div class="card academy-card h-100">
                                        <img :src="academy.avatarUrl" class="card-img-top" :alt="academy.name">
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title" x-text="academy.name"></h5>
                                            <div class="mb-3">
                                                <div class="progress" style="height: 8px;">
                                                    <div class="progress-bar" role="progressbar" :style="`width: ${academy.progress}%`" :aria-valuenow="academy.progress" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <div class="d-flex justify-content-between mt-1">
                                                    <small x-text="`Progress: ${academy.progress}%`"></small>
                                                    <small x-text="academy.nextLesson"></small>
                                                </div>
                                            </div>
                                            <a :href="`/academy/${academy.id}`" class="btn btn-outline-primary mt-auto">Continue Learning</a>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Upcoming Lessons</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item px-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">Introduction to JavaScript</h6>
                                        <small class="text-muted">Web Development Academy</small>
                                    </div>
                                    <span class="badge bg-primary">Tomorrow</span>
                                </div>
                            </li>
                            <li class="list-group-item px-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">Data Visualization Techniques</h6>
                                        <small class="text-muted">Data Science Fundamentals</small>
                                    </div>
                                    <span class="badge bg-secondary">In 3 days</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Recommended Academies</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex mb-3">
                            <img src="https://placehold.co/100x100?text=UI/UX" class="rounded me-3" alt="UI/UX Design">
                            <div>
                                <h6>UI/UX Design Principles</h6>
                                <p class="text-muted small mb-1">Learn to create beautiful, functional interfaces</p>
                                <a href="/academy/4" class="btn btn-sm btn-outline-primary">View Details</a>
                            </div>
                        </div>
                        <div class="d-flex">
                            <img src="https://placehold.co/100x100?text=Mobile" class="rounded me-3" alt="Mobile Development">
                            <div>
                                <h6>Mobile App Development</h6>
                                <p class="text-muted small mb-1">Create native and cross-platform mobile apps</p>
                                <a href="/academy/3" class="btn btn-sm btn-outline-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Teacher Dashboard -->
    <div x-show="userType === 'teacher'">
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">My Teaching Academies</h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            <h5 class="alert-heading">Coming Soon!</h5>
                            <p class="mb-0">The academy content management features will be available in the next version. Stay tuned for updates!</p>
                        </div>
                        
                        <div class="row g-4">
                            <template x-for="academy in teacherAcademies" :key="academy.id">
                                <div class="col-md-6">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h5 class="card-title" x-text="academy.name"></h5>
                                            <p class="card-text text-muted" x-text="academy.shortDescription"></p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="badge bg-primary" x-text="`${academy.students} Students`"></span>
                                                <button class="btn btn-outline-primary btn-sm" disabled>Manage Content</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Parent Dashboard -->
    <div x-show="userType === 'parent'">
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">My Children</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            <template x-for="child in parentChildren" :key="child.id">
                                <div class="col-md-6">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                                    <span x-text="child.name.charAt(0)"></span>
                                                </div>
                                                <div>
                                                    <h5 class="card-title mb-0" x-text="child.name"></h5>
                                                    <small class="text-muted" x-text="`${child.academies.length} Enrolled Academies`"></small>
                                                </div>
                                            </div>
                                            
                                            <h6 class="mb-2">Enrolled Academies:</h6>
                                            <ul class="list-group list-group-flush">
                                                <template x-for="academy in child.academies" :key="academy.id">
                                                    <li class="list-group-item px-0">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <span x-text="academy.name"></span>
                                                            <div>
                                                                <span class="badge bg-success me-2" x-text="`${academy.progress}%`"></span>
                                                                <a :href="`/academy/${academy.id}`" class="btn btn-sm btn-outline-primary">View</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </template>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function dashboardData() {
        return {
            userType: 'student', // Default to student, should be determined by API
            welcomeMessage: 'Welcome back! Here\'s an overview of your activities.',
            
            init() {
                this.fetchUserData();
            },
            
            fetchUserData() {
                // Simulated API call - replace with actual API endpoint
                axios.get('/api/user')
                    .then(response => {
                        this.userType = response.data.userType;
                        this.welcomeMessage = this.getWelcomeMessage();
                    })
                    .catch(error => {
                        console.error('Error fetching user data:', error);
                        
                        // For development: mock data when API is not available
                        // Randomly select a user type for demonstration
                        const types = ['admin', 'student', 'teacher', 'parent'];
                        this.userType = types[Math.floor(Math.random() * types.length)];
                        this.welcomeMessage = this.getWelcomeMessage();
                    });
            },
            
            getWelcomeMessage() {
                switch(this.userType) {
                    case 'admin':
                        return 'Welcome to the admin dashboard. Manage academies and monitor platform activity.';
                    case 'student':
                        return 'Welcome back to your learning journey! Track your progress and continue your courses.';
                    case 'teacher':
                        return 'Welcome to your teaching dashboard. Manage your academies and student progress.';
                    case 'parent':
                        return 'Monitor your children\'s academic progress and enrolled academies.';
                    default:
                        return 'Welcome back! Here\'s an overview of your activities.';
                }
            },
            
            // Mock data for development
            adminAcademies: [
                { id: 1, name: 'Web Development Academy', students: 78, active: true },
                { id: 2, name: 'Data Science Fundamentals', students: 45, active: true },
                { id: 3, name: 'Mobile App Development', students: 32, active: true },
                { id: 4, name: 'UI/UX Design Principles', students: 56, active: false },
                { id: 5, name: 'Cloud Computing', students: 23, active: true },
                { id: 6, name: 'Cybersecurity Essentials', students: 19, active: false }
            ],
            
            studentAcademies: [
                { 
                    id: 1, 
                    name: 'Web Development Academy', 
                    avatarUrl: 'https://placehold.co/600x400?text=Web+Dev',
                    progress: 65,
                    nextLesson: 'JavaScript Basics'
                },
                { 
                    id: 2, 
                    name: 'Data Science Fundamentals', 
                    avatarUrl: 'https://placehold.co/600x400?text=Data+Science',
                    progress: 30,
                    nextLesson: 'Data Visualization'
                }
            ],
            
            teacherAcademies: [
                { 
                    id: 1, 
                    name: 'Web Development Academy', 
                    shortDescription: 'Teaching modern web development with HTML, CSS, JavaScript and more.',
                    students: 78
                },
                { 
                    id: 5, 
                    name: 'Cloud Computing', 
                    shortDescription: 'Teaching cloud platforms, services, and deployment strategies.',
                    students: 23
                }
            ],
            
            parentChildren: [
                {
                    id: 1,
                    name: 'Alex Johnson',
                    academies: [
                        { id: 1, name: 'Web Development Academy', progress: 65 },
                        { id: 3, name: 'Mobile App Development', progress: 40 }
                    ]
                },
                {
                    id: 2,
                    name: 'Sam Johnson',
                    academies: [
                        { id: 4, name: 'UI/UX Design Principles', progress: 75 }
                    ]
                }
            ]
        }
    }
</script>
@endsection
