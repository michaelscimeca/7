import * as THREE from 'three';
import gsap from "gsap";
import { OBJLoader } from "three/examples/jsm/loaders/OBJLoader";
import Stats from 'three/examples/jsm/libs/stats.module'
import { GUI } from 'dat.gui'
var Emitter = require('tiny-emitter');
var emitter = new Emitter();

module.exports = () => {

  const canvas = document.querySelector('canvas.webgl')
  // Scene
  const scene = new THREE.Scene()

  const objectsDistance = 7

  // Material
  const material = new THREE.MeshToonMaterial({ color: '#ffeded' })
  let pick;
  // Meshes
  const mesh1 = new THREE.Mesh(
    new THREE.TorusGeometry(1, 0.4, 16, 60),
    material
  )
  const mesh2 = new THREE.Mesh(
    new THREE.ConeGeometry(1, 2, 32),
    material
  )
  const mesh3 = new THREE.Mesh(
    new THREE.TorusKnotGeometry(0.8, 0.35, 100, 16),
    material
  )

  mesh1.position.y = - objectsDistance * 0
  mesh2.position.y = - objectsDistance * 1
  mesh3.position.y = - objectsDistance * 2

  mesh1.position.x = 2
  mesh2.position.x = - 2
  mesh3.position.x = 2

  const sectionMeshes = [ mesh1, mesh2, mesh3 ]

  // scene.add(mesh1, mesh2, mesh3)

  const particlesCount = 200
  const positions = new Float32Array(particlesCount * 3)

  for(let i = 0; i < particlesCount; i++) {
    positions[i * 3 + 0] = (Math.random() - 0.5) * 10
    positions[i * 3 + 1] = objectsDistance * 0.5 - Math.random() * objectsDistance * sectionMeshes.length
    positions[i * 3 + 2] = (Math.random() - 0.5) * 10
  }

  const particlesGeometry = new THREE.BufferGeometry()
  particlesGeometry.setAttribute('position', new THREE.BufferAttribute(positions, 3))

  // Material
  const particlesMaterial = new THREE.PointsMaterial({
    color: '#ffeded',
    sizeAttenuation: true,
    size: 0.03
  })

  const objLoader = new OBJLoader()

  objLoader.load('/wp-content/themes/wordpress-theme-wordpress-update/library/js/modules/global/three/pick.obj', (event) => {
    pick = event;

    pick.position.x = -44
    pick.position.y = -28.5
    pick.position.x = -4

    camera.lookAt(pick.position);
    scene.add(pick);
    const particles = new THREE.Points(particlesGeometry, particlesMaterial)
    scene.add(particles)
    mesh1.position.x = 2

    const stats = Stats()
document.body.appendChild(stats.dom)

const gui = new GUI()
const cubeFolder = gui.addFolder('event')
cubeFolder.add(pick.position, 'x', -100,100)
cubeFolder.add(pick.position, 'y', -100,100)
cubeFolder.add(pick.position, 'z', -100,100)
cubeFolder.add(pick.rotation, 'x', -100,100)
cubeFolder.add(pick.rotation, 'y', -100,100)
cubeFolder.add(pick.rotation, 'z', -100,100)


cubeFolder.open()
const cameraFolder = gui.addFolder('Camera')
cameraFolder.add(camera.position, 'x', 0, 10)
cameraFolder.add(camera.position, 'y', 0, 10)
cameraFolder.add(camera.position, 'z', 0, 10)

cameraFolder.open()

  });

  // Points


  /**
  * Lights
  */
  const directionalLight = new THREE.DirectionalLight('#ffffff', 1)
  directionalLight.position.set(1, 1, 0)
  scene.add(directionalLight)



  /**
  * Sizes
  */
  const sizes = {
    width: window.innerWidth,
    height: window.innerHeight
  }

  window.addEventListener('resize', () =>
  {
    // Update sizes
    sizes.width = window.innerWidth
    sizes.height = window.innerHeight

    // Update camera
    camera.aspect = sizes.width / sizes.height
    camera.updateProjectionMatrix()

    // Update renderer
    renderer.setSize(sizes.width, sizes.height)
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2))
  })

  /**
  * Scroll
  */
  let scrollY = window.scrollY
  let currentSection = 0

  window.addEventListener('scroll', () =>
  {
    scrollY = window.scrollY
      console.log((Math.cos(window.scrollY)) * 125)
 
      pick.position.x = (Math.cos(window.scrollY)) * 0.25;
  })

  /**
  * Cursor
  */
  const cursor = {}
  cursor.x = 0
  cursor.y = 0

  window.addEventListener('mousemove', (event) =>
  {
    cursor.x = event.clientX / sizes.width - 0.5
    cursor.y = event.clientY / sizes.height - 0.5
  })

  /**
  * Camera
  */
  // Group
  const cameraGroup = new THREE.Group()
  scene.add(cameraGroup)

  // Base camera
  const camera = new THREE.PerspectiveCamera(75, sizes.width / sizes.height, 0.1, 100)
  camera.position.z = 2
  cameraGroup.add(camera)

  /**
  * Renderer
  */
  const renderer = new THREE.WebGLRenderer({
    canvas: canvas,
    alpha: true
  })
  renderer.setSize(sizes.width, sizes.height)
  renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2))



  /**
  * Animate
  */
   emitter.on('changeIt', function (data) {
    console.log(data)
    alert('dada')
    // pick.position.x += -200;
    // pick.position.y += -100;
  });
  const clock = new THREE.Clock()
  let previousTime = 0

  const tick = () => {
    const elapsedTime = clock.getElapsedTime()
    const deltaTime = elapsedTime - previousTime
    previousTime = elapsedTime

    if(pick) {
      // pick.position.x = Math.cos( deltaTime ) * 0.75 + 5.25;
      // Math.PI * 0.25
      // pick.rotation.x += deltaTime * 0.1

    }

    // Animate meshes
  

    // Animate camera
    camera.position.y = - scrollY / sizes.height * objectsDistance

    const parallaxX = cursor.x * 0.5
    const parallaxY = - cursor.y * 0.5

    cameraGroup.position.x += (parallaxX - cameraGroup.position.x) * 5 * deltaTime
    cameraGroup.position.y += (parallaxY - cameraGroup.position.y) * 5 * deltaTime

    // Render
    renderer.render(scene, camera)

    // Call tick again on the next frame
    window.requestAnimationFrame(tick)
  }

  tick()

}
