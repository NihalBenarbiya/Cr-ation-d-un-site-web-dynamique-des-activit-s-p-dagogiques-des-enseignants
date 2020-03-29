package fr.unice.abr;

/**
 * Arbre binaire de recherche. Les �l�ments de l'arbre ont un ordre naturel.
 * Les �l�ments sont rang�s dans l'arbre selon cet ordre ordre naturel.
 * Un arbre ne contient pas de valeur null. Si la racine
 * est null l'arbre est consid�r� comme �tant vide.
 * @version 1.0
 * @param <E> type des valeurs contenues dans l'arbre.
 */
public class ArbreBinaireRecherche<E extends Comparable<? super E>> {
  private Noeud<E> racine;
  /**
   * Nombre de modifications dans l'arbre.
   * Sert � savoir si un it�rateur est encore valable ou pas.
   */
  private int nbModifs;

  /**
   * Cr�e un arbre vide (la racine contient la valeur null).
   */
  public ArbreBinaireRecherche() {
  }

  /**
   * Cr�e un arbre qui ne contient que la valeur elt.
   * @param elt la valeur unique que contient l'arbre.
   */
  public ArbreBinaireRecherche(E elt) {
    if (elt == null) {
      throw new IllegalArgumentException("Un ABR ne contient que des �lements non null");
    }
    racine = new Noeud<E>(elt);
  }

  /**
   * Ins�re un nouvel �l�ment dans l'arbre.
   * Voir aussi variante dans la m�thode insere2.
   * @param elt le nouvel �l�ment qu'on ins�re. Il ne doit pas �tre null.
   */
  public void insere(E elt) {
    if (elt == null) {
      throw new IllegalArgumentException("Un ABR ne contient que des �lements non null");
    }
    if (racine == null) {
      racine = new Noeud<E>(elt);
    }
    else {
      insereRecursif(elt, racine);
    }
  }

  /**
   * Ins�re un �l�ment � partir d'un noeud.
   * Si l'�l�ment est < � la valeur du noeud, il est ins�r� dans l'arborescence
   * du sous-noeud gauche, sinon il est ins�r� � partir du sous-noeud droit.
   * Pr�-condition : le noeud n n'est pas <code>null</code>.
   * @param elt l'�l�ment � ins�rer.
   * @param n Noeud le noeud dans l'arborescence � partir duquel elt 
   * sera ins�r�.
   */
  private void insereRecursif(E elt, Noeud<E> n) {
    if (n.getValeur().compareTo(elt) < 0)
      if (n.getNd() == null)
        n.setNd(new Noeud<E>(elt));
      else
        insereRecursif(elt, n.getNd());
    else
      if (n.getNg() == null)
	    n.setNg(new Noeud<E>(elt));
      else
	    insereRecursif(elt, n.getNg());
  }
  
  /**
   * Variante 2 de insere. Code "plus propre" mais un peu plus difficile � comprendre.
   * Ins�re un nouvel �l�ment dans l'arbre.
   * @param elt E le nouvel �l�ment qu'on ins�re.
   */
  public void insere2(E elt) {
    nbModifs++;
    racine = insereRecursif2(elt, racine);
  }

  /**
   * La diff�rence essentielle avec insereRecursif : retourne un noeud,
   * ce qui permet de pouvoir avoir un noeud null en param�tre.
   * Ins�re un �l�ment � partir d'un certain noeud.
   * @param elt �l�ment � ins�rer.
   * @param n noeud � partir duquel on ins�re.
   * @return le noeud r�sultat de l'insertion.
   */
  private Noeud<E> insereRecursif2(E elt, Noeud<E> n) {
    if (n == null) {
      return new Noeud<E>(elt);
    }
    if (compare(n.valeur, elt) < 0)
      n.nd = insereRecursif2(elt,n.nd);
    else
      n.ng = insereRecursif2(elt, n.ng);
    return n;
  } 

  /**
   * Indique si l'arbre contient un �l�ment �gal (au sens de Comparable)
   * � l'�l�ment pass� en param�tre.
   * @param elt l'�l�ment � rechercher.
   * @return <code>true</code> si l'arbre contient l'�l�ment, 
   * <code>false</code> sinon.
   */
  public boolean contient(Object elt) {
    return contientRecursif(elt, racine);
  }

  private boolean contientRecursif(Object elt, Noeud<E> n) {
    if (n == null)
      return false;
    int v = ((Comparable<? super E>)elt).compareTo(n.getValeur());
    if (v == 0)
      return true;
    else if (v > 0)
      return contientRecursif(elt, n.getNd());
    else
      return contientRecursif(elt, n.getNg());
  }

  public void afficheTesElements() {
    System.out.println("Contenu de l'arbre : ");
    afficheInfixe(racine);
  }

  private void afficheInfixe(Noeud<E> noeud) {
    if (noeud != null) {
      afficheInfixe(noeud.getNg());
      System.out.println(noeud.getValeur());
      afficheInfixe(noeud.getNd());
    }
  }

  @Override
  public String toString() {
    // Retourne "null" si la racine est null (d�finition de "+").
    // Retourne racine.toString() sinon.
    return "" + racine;
  }

  /**
   * Noeud d'un arbre binaire.
   * Classe interne static car elle ne poss�de aucune r�f�rence vers une variable d'instance de
   * la classe englobante.

   * @version 1.0
   */
  private static class Noeud<E> {
    /**
     * Valeur du noeud.
     */
    private E valeur;
    /**
     * Noeuds gauche (ng) et droit (nd) de l'arbre.
     * nd contient les �l�ments sup�rieurs � la valeur du noeud.
     * ng contient les �l�ments inf�rieurs ou �gaux � la valeur du noeud.
     */
    private Noeud<E> nd, ng;

    public Noeud(E valeur, Noeud<E> noeud1, Noeud<E> noeud2) {
      this.valeur = valeur;
      this.nd = noeud1;
      this.ng = noeud2;
    }

    public Noeud(E valeur) {
      this(valeur, null, null);
    }

    public E getValeur() {
      return valeur;
    }

    public Noeud<E> getNd() {
      return nd;
    }

    public Noeud<E> getNg() {
      return ng;
    }

    public void setNd(Noeud<E> noeud) {
      this.nd = noeud;
    }

    public void setNg(Noeud<E> noeud) {
      this.ng = noeud;
    }

    @Override
    public String toString() {
      return "[Noeud:valeur=" + valeur +"; ng=" + ng + "; nd=" + nd + "]";
    }
  } // Fin Noeud<E>

}
