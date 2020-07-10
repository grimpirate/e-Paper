/*****************************************************************************
* | File      	:   EPD_2in13bc_test.c
* | Author      :   Waveshare team
* | Function    :   2.13inch B&C e-paper test demo
* | Info        :
*----------------
* |	This version:   V1.0
* | Date        :   2019-06-13
* | Info        :
#
# Permission is hereby granted, free of charge, to any person obtaining a copy
# of this software and associated documnetation files (the "Software"), to deal
# in the Software without restriction, including without limitation the rights
# to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
# copies of the Software, and to permit persons to  whom the Software is
# furished to do so, subject to the following conditions:
#
# The above copyright notice and this permission notice shall be included in
# all copies or substantial portions of the Software.
#
# THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
# IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
# FITNESS OR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
# AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
# LIABILITY WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
# OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
# THE SOFTWARE.
#
******************************************************************************/
#include "EPD_Test.h"
#include "EPD_2in13b_V2.h"

int EPD_2in13b_V2_test(void)
{
    printf("EPD_2IN13B_V2_test Demo\r\n");
    if(DEV_Module_Init()!=0){
        return -1;
    }

    printf("e-Paper Init and Clear...\r\n");
    EPD_2IN13B_V2_Init();
    EPD_2IN13B_V2_Clear();
    DEV_Delay_ms(500);

    //Create a new image cache named IMAGE_BW and fill it with white
    UBYTE *BlackImage, *RYImage; // Red or Yellow
    UWORD Imagesize = ((EPD_2IN13B_V2_WIDTH % 8 == 0)? (EPD_2IN13B_V2_WIDTH / 8 ): (EPD_2IN13B_V2_WIDTH / 8 + 1)) * EPD_2IN13B_V2_HEIGHT;
    if((BlackImage = (UBYTE *)malloc(Imagesize)) == NULL) {
        printf("Failed to apply for black memory...\r\n");
        return -1;
    }
    if((RYImage = (UBYTE *)malloc(Imagesize)) == NULL) {
        printf("Failed to apply for red memory...\r\n");
        return -1;
    }
    printf("NewImage:BlackImage and RYImage\r\n");
    Paint_NewImage(BlackImage, EPD_2IN13B_V2_WIDTH, EPD_2IN13B_V2_HEIGHT, WHITE);
    Paint_NewImage(RYImage, EPD_2IN13B_V2_WIDTH, EPD_2IN13B_V2_HEIGHT, WHITE);

    // show bmp
    printf("show red bmp------------------------\r\n");
    Paint_SelectImage(BlackImage);
    for (UWORD Y = 0; Y < EPD_2IN13B_V2_HEIGHT/2; Y++) {
        for (UWORD X = 0; X < EPD_2IN13B_V2_WIDTH; X++ ) {
            Paint_SetPixel(X, Y, BLACK);
        }
    }
    Paint_SelectImage(RYImage);
    for (UWORD Y = 0; Y < EPD_2IN13B_V2_HEIGHT/2; Y++) {
        for (UWORD X = 0; X < EPD_2IN13B_V2_WIDTH/2; X++ ) {
            Paint_SetPixel(X, Y, BLACK);
        }
    }
    EPD_2IN13B_V2_Display(BlackImage, RYImage);
    // DEV_Delay_ms(2000);

    printf("Goto Sleep...\r\n");
    EPD_2IN13B_V2_Sleep();
    free(BlackImage);
    free(RYImage);
    BlackImage = NULL;
    RYImage = NULL;

    // close 5V
    printf("close 5V, Module enters 0 power consumption ...\r\n");
    DEV_Module_Exit();
    
    return 0;
}

