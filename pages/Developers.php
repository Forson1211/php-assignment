<?php 
require_once 'pages/includes/Header.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Student Dev Squad</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            background: #111827;
            color: #e5e7eb;
            overflow-x: hidden;
        }
        
        .noise {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 250 250' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)'/%3E%3C/svg%3E");
            opacity: 0.05;
            pointer-events: none;
            z-index: 1;
        }
        
        .dev-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 60px 20px;
            position: relative;
            z-index: 2;
        }
        
        .header {
            text-align: center;
            margin-bottom: 80px;
            position: relative;
        }
        
        .header::before {
            content: "< />";
            position: absolute;
            top: -65px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 70px;
            font-weight: bold;
            color: rgba(139, 92, 246, 0.15);
            z-index: -1;
        }
        
        h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            background: linear-gradient(45deg, #8b5cf6, #ec4899);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            position: relative;
            display: inline-block;
        }
        
        .subtitle {
            font-size: 1.3rem;
            color: #9ca3af;
            max-width: 700px;
            margin: 0 auto;
        }
        
        .team-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 40px;
            perspective: 1000px;
        }
        
        .team-member {
            background: #1e293b;
            border-radius: 24px;
            overflow: hidden;
            position: relative;
            transition: all 0.4s ease;
            transform-style: preserve-3d;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .team-member:hover {
            transform: translateY(-10px) rotateY(5deg);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.25);
            border: 1px solid rgba(139, 92, 246, 0.3);
        }
        
        .team-member::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.15), rgba(236, 72, 153, 0.15));
            opacity: 0;
            transition: opacity 0.3s;
            z-index: 0;
        }
        
        .team-member:hover::before {
            opacity: 1;
        }
        
        .member-img {
            position: relative;
            height: 580px;
            overflow: hidden;
            clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%);
        }
        
        .member-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: grayscale(30%);
            transition: filter 0.3s, transform 0.5s;
        }
        
        .team-member:hover .member-img img {
            filter: grayscale(0%);
            transform: scale(1.05);
        }
        
        .role-badge {
            position: absolute;
            bottom: 30px;
            left: 10px;
            padding: 8px 16px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            z-index: 3;
        }
        
        .backend {
            background: linear-gradient(45deg, #06b6d4, #0891b2);
            color: white;
        }
        
        .frontend {
            background: linear-gradient(45deg, #3b82f6, #1d4ed8);
            color: white;
        }
        
        .lead {
            background: linear-gradient(45deg, #8b5cf6, #7c3aed);
            color: white;
        }
        
        .fullstack {
            background: linear-gradient(45deg, #f59e0b, #d97706);
            color: white;
        }
        
        .member-info {
            padding: 25px;
            position: relative;
            z-index: 2;
        }
        
        .member-name {
            font-size: 1.6rem;
            font-weight: 700;
            margin-bottom: 6px;
            color: white;
        }
        
        .member-caption {
            color: #9ca3af;
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        
        .tech-stack {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-top: 15px;
        }
        
        .tech-tag {
            background: rgba(255, 255, 255, 0.1);
            color: #d1d5db;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            backdrop-filter: blur(4px);
        }
        
        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }
        
        .social-link {
            color: #9ca3af;
            text-decoration: none;
            transition: color 0.2s;
            font-size: 0.9rem;
            padding: 5px 0;
            position: relative;
        }
        
        .social-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background: linear-gradient(90deg, #8b5cf6, #ec4899);
            transition: width 0.3s;
        }
        
        .social-link:hover {
            color: white;
        }
        
        .social-link:hover::after {
            width: 100%;
        }
        
        .decorative-circle {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(45deg, #8b5cf6, #ec4899);
            filter: blur(80px);
            opacity: 0.15;
            z-index: -1;
        }
        
        .circle-1 {
            top: -100px;
            right: -100px;
            width: 300px;
            height: 300px;
        }
        
        .circle-2 {
            bottom: -150px;
            left: -150px;
            width: 500px;
            height: 500px;
        }

        .team-message {
            background: white;
            margin-top: 60px;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        
        .team-message h2 {
            color: #1a2a6c;
            margin-bottom: 20px;
            font-size: 1.8rem;
        }
        
        .team-message p {
            margin-bottom: 15px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }
        
        @media (max-width: 768px) {
            h1 {
                font-size: 2.5rem;
            }
            
            .subtitle {
                font-size: 1.1rem;
            }
            
            .team-grid {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 30px;
            }

            .team-message {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="noise"></div>
    <div class="decorative-circle circle-1"></div>
    <div class="decorative-circle circle-2"></div>
    
    <div class="dev-container">
        <div class="header">
            <h1>PHP & JAVASCRIPT PHANTOMS</h1>
            <p class="subtitle">Just four students with laptops turning PHP code into digital magic. From database to frontend, we make it happen.</p>
        </div>
        
        <div class="team-grid">
            <div class="team-member">
                <div class="member-img">
                    <img src="src/images/dev1.JPG" alt="Gorden">
                    <div class="role-badge lead">Team Lead + Full Stack</div>
                </div>
                <div class="member-info">
                    <h3 class="member-name">Gorden Archer</h3>
                    <p class="member-caption">
                        The visionary who somehow manages to keep us on track while wearing both frontend and backend hats. Coffee consumption: legendary.
                    </p>
                    <div class="tech-stack">
                        <span class="tech-tag">PHP</span>
                        <span class="tech-tag">MySQL</span>
                        <span class="tech-tag">HTML/CSS</span>
                        <span class="tech-tag">JavaScript</span>
                    </div>
                    <div class="social-links">
                        <a href="https://github.com/GordenArcher/" class="social-link">GitHub</a>
                        <a href="https://linkedin.com/in/gordenarcher/" class="social-link">LinkedIn</a>
                        <a href="https://gorden-portfolio.vercel.app/" class="social-link">Portfolio</a>
                    </div>
                </div>
            </div>
            
            <div class="team-member">
                <div class="member-img">
                    <img src="src/images/dev2.jpeg" alt="Sam">
                    <div class="role-badge frontend">Frontend</div>
                </div>
                <div class="member-info">
                    <h3 class="member-name">Forson</h3>
                    <p class="member-caption">
                        UX enthusiast by day, database wizard by night. Makes interfaces that look good AND work well. A true PHP artisan.
                    </p>
                    <div class="tech-stack">
                        <span class="tech-tag">HTML</span>
                        <span class="tech-tag">JavaScript</span>
                        <span class="tech-tag">CSS</span>
                        <span class="tech-tag">Tailwind</span>
                    </div>
                    <div class="social-links">
                        <a href="https://github.com/Forson1211/" class="social-link">GitHub</a>
                        <a href="#" class="social-link">LinkedIn</a>
                    </div>
                </div>
            </div>
            
            <div class="team-member">
                <div class="member-img">
                    <img src="src/images/dev4.JPG" alt="Micheal">
                    <div class="role-badge frontend">Frontend</div>
                </div>
                <div class="member-info">
                    <h3 class="member-name">Micheal</h3>
                    <p class="member-caption">
                        Query optimizer extraordinaire who also has a knack for making forms that actually validate correctly. The PHP debugger we all need.
                    </p>
                    <div class="tech-stack">
                        <span class="tech-tag">HTML</span>
                        <span class="tech-tag">CSS</span>
                        <span class="tech-tag">JavaScript</span>
                        <span class="tech-tag">Bootstrap</span>
                    </div>
                    <div class="social-links">
                        <a href="https://github.com/Forson1211/" class="social-link">GitHub</a>
                        <a href="#" class="social-link">LinkedIn</a>
                    </div>
                </div>
            </div>
            
            <div class="team-member">
                <div class="member-img">
                    <img src="src/images/dev3.JPG" alt="Kelvin">
                    <div class="role-badge frontend">UI/UX</div>
                </div>
                <div class="member-info">
                    <h3 class="member-name">Kelvin</h3>
                    <p class="member-caption">
                        The problem-solver who can turn spaghetti code into a gourmet meal. Specializes in making JavaScript do things the docs say it can't.
                    </p>
                    <div class="tech-stack">
                        <span class="tech-tag">PHP</span>
                        <span class="tech-tag">jQuery</span>
                        <span class="tech-tag">AJAX</span>
                        <span class="tech-tag">MySQL</span>
                    </div>
                    <div class="social-links">
                        <a href="#" class="social-link">GitHub</a>
                        <a href="#" class="social-link">Linkedin</a>
                    </div>
                </div>
            </div>

                        
            <!-- <div class="team-member">
                <div class="member-img">
                    <img src="src/images/dev5.JPG" alt="Micheal">
                    <div class="role-badge frontend">Frontend</div>
                </div>
                <div class="member-info">
                    <h3 class="member-name">Micheal</h3>
                    <p class="member-caption">
                        Query optimizer extraordinaire who also has a knack for making forms that actually validate correctly. The PHP debugger we all need.
                    </p>
                    <div class="tech-stack">
                        <span class="tech-tag">HTML</span>
                        <span class="tech-tag">CSS</span>
                        <span class="tech-tag">JavaScript</span>
                        <span class="tech-tag">Bootstrap</span>
                    </div>
                    <div class="social-links">
                        <a href="https://github.com/Forson1211/" class="social-link">GitHub</a>
                        <a href="#" class="social-link">LinkedIn</a>
                    </div>
                </div>
            </div> -->

        </div>

        <div class="team-message">
            <h2>Our Development Philosophy</h2>
            <p>As a team, we believe technology should serve environmental and social good. We built this platform with sustainability in mind, from the efficient code that minimizes server load to the accessible design that ensures everyone can participate in the movement against plastic pollution.</p>
            <p>This project was developed as part of our coursework at Pentecost University, combining our technical skills with our passion for environmental conservation. We're proud to contribute to PlasticPollutions' important mission.</p>
        </div>
    </div>
</body>
</html>

<?php require_once 'pages/includes/footer.php'; ?>