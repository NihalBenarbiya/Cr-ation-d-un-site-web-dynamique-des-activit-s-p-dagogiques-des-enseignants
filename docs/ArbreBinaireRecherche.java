package fr.unice.abr;

/**
 * Arbre binaire de recherche. Les éléments de l'arbre ont un ordre naturel.
 * Les éléments sont rangés dans l'arbre selon cet ordre ordre naturel.
 * Un arbre ne contient pas de valeur null. Si la racine
 * est null l'arbre est considéré comme étant vide.
 * @version 1.0
 * @param <E> type des valeurs contenues dans l'arbre.
 */
public class ArbreBinaireRecherche<E extends Comparable<? super E>> {
  private Noeud<E> racine;
  /**
   * Nombre de modifications dans l'arbre.
   * Sert à savoir si un itérateur est encore valable ou pas.
   */
  private int nbModifs;

  /**
   * Crée un arbre vide (la racine contient la valeur null).
   */
  public ArbreBinaireRecherche() {
  }

  /**
   * Crée un arbre qui ne contient que la valeur elt.
   * @param elt la valeur unique que contient l'arbre.
   */
  public ArbreBinaireRecherche(E elt) {
    if (elt == null) {
      throw new IllegalArgumentException("Un ABR ne contient que des élements non null");
    }
    racine = new Noeud<E>(elt);
  }

  /**
   * Insère un nouvel élément dans l'arbre.
   * Voir aussi variante dans la méthode insere2.
   * @param elt le nouvel élément qu'on insère. Il ne doit pas être null.
   */
  public void insere(E elt) {
    if (elt == null) {
      throw new IllegalArgumentException("Un ABR ne contient que des élements non null");
    }
    if (racine == null) {
      racine = new Noeud<E>(elt);
    }
    else {
      insereRecursif(elt, racine);
    }
  }

  /**
   * Insère un élément à partir d'un noeud.
   * Si l'élément est < à la valeur du noeud, il est inséré dans l'arborescence
   * du sous-noeud gauche, sinon il est inséré à partir du sous-noeud droit.
   * Pré-condition : le noeud n n'est pas <code>null</code>.
   * @param elt l'élément à insérer.
   * @param n Noeud le noeud dans l'arborescence à partir duquel elt 
   * sera inséré.
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
   * Variante 2 de insere. Code "plus propre" mais un peu plus difficile à comprendre.
   * Insère un nouvel élément dans l'arbre.
   * @param elt E le nouvel élément qu'on insère.
   */
  public void insere2(E elt) {
    nbModifs++;
    racine = insereRecursif2(elt, racine);
  }

  /**
   * La différence essentielle avec insereRecursif : retourne un noeud,
   * ce qui permet de pouvoir avoir un noeud null en paramètre.
   * Insère un élément à partir d'un certain noeud.
   * @param elt élément à insérer.
   * @param n noeud à partir duquel on insère.
   * @return le noeud résultat de l'insertion.
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
   * Indique si l'arbre contient un élément égal (au sens de Comparable)
   * à l'élément passé en paramètre.
   * @param elt l'élément à rechercher.
   * @return <code>true</code> si l'arbre contient l'élément, 
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
    // Retourne "null" si la racine est null (définition de "+").
    // Retourne racine.toString() sinon.
    return "" + racine;
  }

  /**
   * Noeud d'un arbre binaire.
   * Classe interne static car elle ne possède aucune référence vers une variable d'instance de
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
     * nd contient les éléments supérieurs à la valeur du noeud.
     * ng contient les éléments inférieurs ou égaux à la valeur du noeud.
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
