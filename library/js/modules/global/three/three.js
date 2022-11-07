import * as THREE from 'three';
import gsap from "gsap";
import { OBJLoader } from "three/examples/jsm/loaders/OBJLoader";
import Stats from 'three/examples/jsm/libs/stats.module'
import { GUI } from 'dat.gui'
var Emitter = require('tiny-emitter');
var emitter = new Emitter();

module.exports = () => {
  let pick = {};
  const canvas = document.querySelector('canvas.webgl')
  const sizes = {
    width: window.innerWidth,
    height: window.innerHeight
  }

  // Scene
  const scene = new THREE.Scene()
  // Renderer
  const renderer = new THREE.WebGLRenderer({
    canvas: canvas,
    alpha: true
  })
  
  renderer.setSize(sizes.width, sizes.height)
  renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2))

  const mesh = new THREE.Mesh(
    new THREE.BoxGeometry(1,1,1),
    new THREE.MeshBasicMaterial({ color: 'oxff000'})
  )

  scene.add(mesh)

  // Lights
  // const directionalLight = new THREE.DirectionalLight('#ffffff', 1)
  // directionalLight.position.set(1, 1, 0)
  // scene.add(directionalLight)

  const camera = new THREE.PerspectiveCamera(75, sizes.width / sizes.height);
  // camera.position.x = 2;
  // camera.position.y = 2;
  // camera.position.x = 2;
  camera.position.z = 3
  camera.lookAt(mesh.position)
  scene.add(camera)

  window.addEventListener('resize', ()=>{
    sizes.width = window.innerWidth
    sizes.height = window.innerHeight
    camera.aspect = sizes.width / sizes.height;
    camera.updateProjectionMatrix();
    renderer.setSize(sizes.width, sizes.height)
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2))
  })


 // Clock
 const clock = new THREE.Clock();

  const tick = () => {
    const elapsedTime = clock.getElapsedTime();
    console.log(elapsedTime)
    // mesh.rotation.y = elapsedTime * Math.PI * 2;
    // mesh.rotation.y = Math.sin(elapsedTime) 
    // mesh.position.x = Math.cos(elapsedTime) 
    // mesh.position.z = Math.sin(elapsedTime) 
    camera.position.y = Math.sin(elapsedTime * Math.PI * 2) 
    camera.position.x = Math.sin(elapsedTime * Math.PI * 2) 
    camera.rotation.z = Math.cos(elapsedTime * Math.PI * 2)

    // camera.position.z = Math.sin(elapsedTime) 

  //   const elapsedTime = clock.getElapsedTime()
  //   const deltaTime = elapsedTime - previousTime
  //   previousTime = elapsedTime

  //   // if(pick) {
  //   //   pick.rotation.x += deltaTime * 0.1
  //   //   pick.rotation.y += deltaTime * 0.1
  //   // }

  //   // Animate meshes
  //   console.log(Math.sin( cursors.y * Math.PI * 2))
  //   // Animate camera
  //   camera.position.x = Math.sin( cursors.x * Math.PI * 2)
  //   camera.position.z = Math.cos( cursors.y * Math.PI * 2)
    // Render
  renderer.render(scene, camera)

  //   // Call tick again on the next frame
    window.requestAnimationFrame(tick)
  }

  tick()

//   const objLoader = new OBJLoader()


//   objLoader.load('/wp-content/themes/wordpress-theme-wordpress-update/library/js/modules/global/three/pick.obj', (event) => {
//     pick = event;

//     pick.position.x = -44
//     pick.position.y = -28.5
//     pick.position.x = -4

//     camera.lookAt(pick.position);
//     scene.add(pick);
//     const particles = new THREE.Points(particlesGeometry, particlesMaterial)
//     scene.add(particles)
//     mesh1.position.x = 2

// //     const stats = Stats()
// // document.body.appendChild(stats.dom)

// // const gui = new GUI()
// // const cubeFolder = gui.addFolder('event')
// // cubeFolder.add(pick.position, 'x', -100,100)
// // cubeFolder.add(pick.position, 'y', -100,100)
// // cubeFolder.add(pick.position, 'z', -100,100)
// // cubeFolder.add(pick.rotation, 'x', -100,100)
// // cubeFolder.add(pick.rotation, 'y', -100,100)
// // cubeFolder.add(pick.rotation, 'z', -100,100)


// // cubeFolder.open()
// // const cameraFolder = gui.addFolder('Camera')
// // cameraFolder.add(camera.position, 'x', 0, 10)
// // cameraFolder.add(camera.position, 'y', 0, 10)
// // cameraFolder.add(camera.position, 'z', 0, 10)

// // cameraFolder.open()

//   });

  // Points




  /**
  * Sizes
  */

  // window.addEventListener('resize', () =>
  // {
  //   // Update sizes
  //   sizes.width = window.innerWidth
  //   sizes.height = window.innerHeight

  //   // Update camera
  //   camera.aspect = sizes.width / sizes.height
  //   camera.updateProjectionMatrix()

  //   // Update renderer
  //   renderer.setSize(sizes.width, sizes.height)
  //   renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2))
  // })

  /**
  * Scroll
  */
  // Base camera




  /**
  * Animate
  // */
  // const clock = new THREE.Clock()
  // let previousTime = 0

  // const cursors = {
  //   x: 0, // Hide
  //   y: 0,
  // }

  // window.addEventListener('mousemove', (event) => {
  //   cursors.x = event.clientX
  //   cursors.y = event.clientY
  // })


}
