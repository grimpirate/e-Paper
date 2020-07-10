DIR_Config   = ./lib/Config
DIR_EPD      = ./lib/e-Paper
DIR_GUI      = ./lib/GUI
DIR_Examples = ./examples
DIR_BIN      = ./bin

OBJ_C = $(wildcard ${DIR_EPD}/*.c ${DIR_GUI}/*.c ${DIR_Examples}/*.c )
OBJ_O = $(patsubst %.c,${DIR_BIN}/%.o,$(notdir ${OBJ_C}))
RPI_DEV_C = $(wildcard $(DIR_BIN)/DEV_Config.o )


DEBUG = -D DEBUG

USELIB_RPI = USE_WIRINGPI_LIB
LIB_RPI = -lwiringPi -lm 
DEBUG_RPI = -D $(USELIB_RPI) -D RPI

RPI:RPI_epd 

TARGET = epd
CC = gcc
MSG = -g -O0 -Wall
CFLAGS += $(MSG)

RPI_epd:${OBJ_O}
	echo $(@)
	$(CC) $(CFLAGS) -D RPI $(OBJ_O) $(RPI_DEV_C) -o $(TARGET) $(LIB_RPI) $(DEBUG)
    
${DIR_BIN}/%.o:$(DIR_Examples)/%.c
	$(CC) $(CFLAGS) -c  $< -o $@ -I $(DIR_Config) -I $(DIR_GUI) -I $(DIR_EPD) $(DEBUG)
    
${DIR_BIN}/%.o:$(DIR_EPD)/%.c
	$(CC) $(CFLAGS) -c  $< -o $@ -I $(DIR_Config) $(DEBUG)
    
${DIR_BIN}/%.o:$(DIR_GUI)/%.c
	$(CC) $(CFLAGS) -c  $< -o $@ -I $(DIR_Config) $(DEBUG)
