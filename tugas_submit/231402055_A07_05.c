/*
    Nama Kelompok : Kelompok 7
	Anggota : 1. 231402010 - Jeremia Hasudungan Sitinjak
			  2. 231402028 - Alfi Syahrin
              3. 231402031 - Carlos Donal Halomoan Sirait
              4. 231402055 - Refael Juari Siagian
	Nama File : 231402055_A07_05.c  
	Deskripsi file : Program untuk mengalikan dua bilangan dengan fungsi rekursif
*/


#include<stdio.h>

int kali(int, int);

int main()
{
    int a, b;

    printf("\n== PROGRAM MENGALIKAN BILANGAN ==\n");
    printf("\nMasukkan bilangan yang akan dikali dan pengali (bil1 bil2): ");
    scanf("%d %d", &a, &b);

    int hasil = kali(a, b);

    printf("Hasil perkalian adalah: %d\n", hasil);

    return 0;
}

int kali(int bil1, int bil2){

    if (bil2 == 0){
        return 0;
    } else {
        return bil1 + kali(bil1, bil2 - 1);
    }

}
