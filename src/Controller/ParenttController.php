<?php


namespace App\Controller;


use App\Entity\Parentt;
use App\Form\ParenttFormType;
use App\Repository\ParenttRepository;
use App\Repository\ProProfilRepository;
use App\Services\FileUploader;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ParenttController extends AbstractController
{

    /**
     * @Route("/parent/{id}/dashboard", name="dashboardparent")
     */
    public function dashboardparentt(ProProfilRepository $profilRepository, ParenttRepository $parenttRepository, $id, Parentt $parentt)
    {
        $enfants = $parenttRepository->findByEnfant($id);


        if ($enfants[0]['nom'] != null) {
            $data = array();
            foreach ($enfants as $row) {


                $data[] = array(
                    'prenom' => $row['prenom'],
                    'nom' => $row['nom'],
                    'id' => $row['id']
                );
            }

            return $this->render('parent/dashboard.html.twig', [
                'parent' => $parentt,
                'data' => $data,
            ]);

        } else{
            return $this->render('parent/dashboard.html.twig', [
                'parent' => $parentt
                ]);
        }

    }

    /**
     * @Route("/parent/{id}/edit", name="editparent")
     */
    public function editparentt(Request $request, Parentt $parentt, FileUploader $fileUploader)
    {
        $form = $this->createForm(ParenttFormType::class, $parentt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //Upload de fichier pour le revenu
            //On définit notre variable revenu qui récupère le fichier mis dans le formulaire
            /** @var UploadedFile $revenus */
            $revenus = $form->get('revenu')->getData();
            if (isset($revenus)){
                $test = '/fichiers/parents/revenus/';
                $revenusName = $fileUploader->upload($revenus, $test);
                $parentt->setRevenu($revenusName);
            }

            //Upload de la déclaration de la caf
            /** @var UploadedFile $caf */
            $caf = $form->get('attestationcaf')->getData();
            if (isset($caf)){
                $pathcaf = '/fichiers/parents/caf/';
                $cafName = $fileUploader->upload($caf, $pathcaf);
                $parentt->setAttestationcaf($cafName);
            }

            //Upload du livret de famille
            /** @var UploadedFile $livret */
            $livret = $form->get('livretdefamille')->getData();
            if (isset($livret)){
                $pathlivret = '/fichiers/parents/livretdefamille/';
                $livretName = $fileUploader->upload($livret, $pathlivret);
                $parentt->setLivretdefamille($livretName);
            }

            //Upload du justificatif de domicile
            /** @var UploadedFile $domicile */
            $domicile = $form->get('justificatifdomicile')->getData();
            if (isset($domicile)){
                $pathdomicile = '/fichiers/parents/justificatifdomicile/';
                $domicileName = $fileUploader->upload($domicile, $pathdomicile);
                $parentt->setJustificatifdomicile($domicileName);
            }

            //Upload de la déclaration d'impôts
            /** @var UploadedFile $impots */
            $impots = $form->get('impots')->getData();
            if (isset($impots)){
                $pathimpots = '/fichiers/parents/impots/';
                $impotsName = $fileUploader->upload($impots, $pathimpots);
                $parentt->setImpots($impotsName);
            }


            $em = $this->getDoctrine()->getManager();
            $em->persist($parentt);
            $em->flush();

            $em = $this->getDoctrine()->getManager();
            $em->persist($parentt);
            $em->flush();


            return $this->redirectToRoute('dashboardparent', [
                'id' => $parentt->getId(),
            ]);
        }

        return $this->render('parent/profil_parent.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    private function generateUniqueFileName()
    {
        md5(uniqid());
    }

    /**
     * @Route("/parent/{id}/modifmotdepasse", name="modifpassword")
     */
    public function modifpassword(Request $request, $id, UserPasswordEncoderInterface $encoder)
    {

        if ($request->isMethod("POST"))
        {
            $em = $this->getDoctrine()->getManager();
            $um = $em->getRepository(Parentt::class)->findOneBy(["id" => $id]);

            $old = $request->request->get('old_password');
            $new = $request->request->get('new_password');
            $confirme = $request->request->get('confirm_new_password');

            if ($encoder->isPasswordValid($um,$old))
            {
                if ($new === $confirme)
                {
                    $um->setPassword($encoder->encodePassword($um, $confirme));

                    $em->flush();

                    $test = $this->addFlash("success", "Votre mot de passe à bien été modifier !");

                    return $this->redirectToRoute("dashboardparent",[
                        'id' => $id,
                        'test'=> $test
                    ]);

                }else
                    {
                    $this->addFlash("danger", "Erreur de confirmation mot de passe");
                }


            }else{
                $this->addFlash("danger", "Erreur de l'ancien mot de passe");
            }



        }
        return $this->render("parent/modifmdp_parent.html.twig");

    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {

    }

}