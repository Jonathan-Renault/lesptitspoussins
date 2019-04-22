<?php


namespace App\Controller;


use App\Entity\ProProfil;
use App\Form\ProProfilFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class ProController extends AbstractController
{

    /**
     * @Route("/pro/dashboard/{id}", name="prodashboard")
     */
    public function dashboard(ProProfil $proProfil)
    {
        return $this->render('pro/pro_dashboard.html.twig', [
            'pro' => $proProfil
        ]);
    }

    /**
     * @Route("/pro/profil/{id}/edit", name="editproprofil")
     */
    public function editprofil(Request $request, ProProfil $proProfil)
    {
        $form = $this->createForm(ProProfilFormType::class, $proProfil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            if($proProfil->getAdresse() != $form->get("adresse") || $proProfil->getCodepostal() != $form->get("codepostal") || $proProfil->getVille() != $form->get("ville"))
            {
                $street = $form->get("adresse");
                $ville = $form->get("ville");
                $codepostal = $form->get("codepostal");

                $adress = array(
                    'street'    => $street,
                    'city'      => $ville,
                    'postalcode'=>  $codepostal,
                    'country'   =>  'France',
                    'format'    =>  'json'
                );
                // Création d'une nouvelle ressource cURL
                $ch = curl_init("https://nominatim.openstreetmap.org/?". http_build_query($adress));

                // Configuration de l'URL et d'autres options
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_USERAGENT, 'Mettre ici un user-agent adéquat');

                // Récupération de l'URL et affichage sur le navigateur
                $g = curl_exec($ch);

                // Fermeture de la session cURL
                curl_close($ch);

                $json_data = json_decode($g,true);

                $proProfil->setLatitude($json_data[0]['lat']);
                $proProfil->setLongitude($json_data[0]['lon']);

            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($proProfil);
            $em->flush();

            return $this->redirectToRoute('prodashboard', [
                'id' => $proProfil->getId()
            ]);
        }

        return $this->render('pro/pro_profil.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {

    }

}